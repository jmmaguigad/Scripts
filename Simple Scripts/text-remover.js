<script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script type="text/javascript">
console.log("it works");
console.log($("#player p").contents());
$(document).ready(function () {
	$("#player p").contents().filter(function () {
	     return this.nodeType === 3; //nodeType 3 => text node; for reference: https://www.w3schools.com/jsref/prop_node_nodetype.asp
	}).remove();	
});
</script>