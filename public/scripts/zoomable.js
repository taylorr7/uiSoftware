const loadD3 = (data) => {
    drawCirclePacking(data);
};

$('#sumbit-comment').click(function(e) {
    const courseId = $(this).attr("data-course");
    const content = $("#course-comment").val();

    $.get(`${BASE_URL}/courses/view/${courseId}/comment`, {content}, (data) => {
            console.log(data);
        }, 'json');
});

const drawCirclePacking = (data) => {

    const zoom = (d) => {
        focus = d;

        const transition = d3.transition()
            .duration(d3.event.altKey ? 7500 : 750)
            .tween("zoom", (d) => {
                var i = d3.interpolateZoom(view, [focus.x, focus.y, focus.r * 2 + margin]);
                return (t) => {
                    zoomTo(i(t));
                };
            });

        transition.selectAll("text")
            .filter(function(d) {
                return d.parent === focus || this.style.display === "inline";
            })
            .style("fill-opacity", (d) => d.parent === focus ? 1 : 0)
            .on("start", function(d) {
                if (d.parent === focus) this.style.display = "inline";
            })
            .on("end", function(d) {
                if (d.parent !== focus) this.style.display = "none";
            });
    };

    const zoomTo = (v) => {
        const k = diameter / v[2];
        view = v;
        node.attr("transform", (d) => `translate(${(d.x - v[0]) * k},${(d.y - v[1]) * k})`);
        circle.attr("r", (d) => d.r * k);
    };

    const svg = d3.select("svg");
    const margin = 20;
    const diameter = +svg.attr("width");
    const g = svg.append("g")
        .attr("transform", `translate(${diameter/2},${diameter/2})`);

    const color = d3.scaleLinear()
        .domain([-1, 5])
        .range(["hsl(152,80%,80%)", "hsl(228,30%,40%)"])
        .interpolate(d3.interpolateHcl);

    const pack = d3.pack()
        .size([diameter - margin, diameter - margin])
        .padding(2);

    const root = d3.hierarchy(data)
        .sum((d) => d.size)
        .sort((a, b) => b.value - a.value);

    const nodes = pack(root).descendants();
    let focus = root;
    let view;

    const circle = g.selectAll("circle")
        .data(nodes)
        .enter().append("circle")
        .attr("class", (d) =>
            d.parent ? d.children ? "node" : "node node--leaf" : "node node--root"
        )
        .style("fill", (d) => d.children ? color(d.depth) : null)
        .on("click", (d) => {
            if (d.data.name === "Add Comment") {
                $('#comment-modal').modal('show');
                $('#sumbit-comment').attr('data-course', d.data.courseId);
            }

            if (focus !== d) zoom(d.children ? d : d.parent);

            d3.event.stopPropagation();
        });

    const text = g.selectAll("text")
        .data(nodes)
        .enter().append("text")
        .attr("class", "label")
        .style("fill-opacity", (d) => d.parent === root ? 1 : 0)
        .style("display", (d) => d.parent === root ? "inline" : "none")
        .text((d) => d.data.name);

    const node = g.selectAll("circle, text");

    svg.style("background", color(-1))
        .on("click", () => {
            zoom(root);
        });

    zoomTo([root.x, root.y, root.r * 2 + margin]);
};
