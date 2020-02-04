<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <title> Basic example </title>
	
	
	<link rel="stylesheet" type="text/css" href="{{ asset('tree/Treant.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('tree/examples/basic-example/basic-example.css') }}">
    
</head>
<body>
    <div class="chart" id="basic-example"></div>
	<script src="{{ asset('tree/vendor/raphael.js') }}"></script>
	<script src="{{ asset('tree/Treant.js') }}"></script>
	<!--<script src="{{ asset('tree/examples/basic-example/basic-example.js') }}"></script>-->
    <script>	
	var config = {
        container: "#basic-example",
        
        connectors: {
            type: 'step'
        },
        node: {
            HTMLclass: 'nodeExample1'
        }
    },
	
    first_level = {
        text: {
            name: "<?php echo $tree_array->value; ?>",
            title: "",
            contact: "",
        },
        image: ""
    },

    left = {
        parent: first_level,
        text:{
            name: "<?php echo $tree_array->left->value; ?>",
            title: "",
        },
        stackChildren: true,
        image: ""
    },
	right = {
        parent: first_level,
        text:{
            name: "<?php echo $tree_array->right->value; ?>",
            title: "",
        },
        stackChildren: true,
        image: ""
    },
	left_right = {
        parent: left,
        text:{
            name: "<?php echo $tree_array->left->right->value; ?>",
            title: "",
        },
        stackChildren: true,
        image: ""
    },
	left_left = {
        parent: left,
        text:{
            name: "<?php echo $tree_array->left->left->value; ?>",
            title: "",
        },
        stackChildren: true,
        image: ""
    },
	right_right = {
        parent: right,
        text:{
            name: "<?php echo $tree_array->right->right->value; ?>",
            title: "",
        },
        stackChildren: true,
        image: ""
    },
	right_left = {
        parent: right,
        text:{
            name: "<?php echo $tree_array->right->left->value; ?>",
            title: "",
        },
        stackChildren: true,
        image: ""
    },



    chart_config = [
        config,
        first_level,
		left,
		right,
		left_right,
		left_left,
		right_right,
		right_left,
    ];
	
	
	
	
	new Treant( chart_config );
		
    </script>
</body>
</html>