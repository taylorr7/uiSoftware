const svgWidth = 500;
const svgHeight = 200;
const svg = d3.select("svg").attr("viewBox", `0 0 ${svgWidth} ${svgHeight}`);
const margin = {top: 20, right: 20, bottom: 70, left: 30};
const width = svgWidth - margin.left - margin.right;
const height = svgHeight - margin.top - margin.bottom;
const g = svg.append("g").attr("transform", `translate(${margin.left},${margin.top})`);

const parseTime = d3.timeParse("%Y-%m-%d");

const x = d3.scaleTime()
    .rangeRound([0, width]);

const y = d3.scaleLinear()
    .rangeRound([height, 0]);

const line = d3.line()
    .x((d) => x(d.day))
    .y((d) => y(+d.count));

const loadD3 = (data) => {
    data = data.map(({day, count}) => ({day: parseTime(day), count}));

    x.domain(d3.extent(data, (d) => d.day));
    y.domain(d3.extent(data, (d) => +d.count));

    g.append("g")
        .attr("class", "axis axis--x")
        .attr("transform", `translate(0,${height})`)
        .call(d3.axisBottom(x))
        .selectAll("text")
        .attr("y", 0)
        .attr("x", 9)
        .attr("dy", ".35em")
        .attr("transform", "rotate(90)")
        .style("text-anchor", "start");

    g.append("g")
        .attr("class", "axis axis--y")
        .call(d3.axisLeft(y))
        .append("text")
        .attr("fill", "#000")
        .attr("transform", "rotate(-90)")
        .attr("y", 6)
        .attr("dy", "0.71em")
        .style("text-anchor", "end")
        .text("Activity");

    g.append("path")
        .datum(data)
        .attr("class", "line")
        .attr("d", line);
};
