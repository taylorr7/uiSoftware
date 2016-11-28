<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/styles/zoomable.css">
<svg width="960" height="960"></svg>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="<?= BASE_URL ?>/public/scripts/zoomable.js"></script>
<script>
	loadD3(<?= json_encode($courseData) ?>);
</script>