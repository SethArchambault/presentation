<!DOCTYPE html>
<html lang="en-US">
<head>
<title>CAPITALIST REALISM</title>
<meta charset="utf-8"/>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<style>
html {-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; -webkit-tap-highlight-color: transparent;     }
body {
margin: 0;
line-height: 1;
font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
}
ul,ol {
margin-top: 0;
margin-bottom: 0;
padding-left: 15px;
}
h1,h2,h3,h4,h5,h6 {
margin-top: 0;
margin-bottom: 0;
font-size: inherit;
}
p {
margin-top: 0;
margin-bottom: 0;
}
img {
border: 0;
max-width: 100%;
height: auto;
vertical-align: middle;
}
a {
color: inherit;
}
::-moz-focus-inner {
border: 0;
padding: 0;
}
button {border: 0; margin: 0; padding: 0; text-align: inherit; text-transform: inherit; font: inherit; -webkit-font-smoothing: inherit; letter-spacing: inherit; background: none;       cursor: pointer; overflow: visible; }


body {
background:linear-gradient(to left, #21618C, #1ABC9C);
background-color:#000;
color:#fff;
}
.slide {
height:100vh;
width: 100vw;
align:center;
display:flex;
justify-content:center;
align-items: center;
font-size:60px;
text-transform:uppercase;
letter-spacing:2px;  
font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
color:#cddee6;
}
.sidebar {
display:flex;
flex-direction:column;
text-align:right;
justify-content:center;
position:fixed;
right:0;
height:100vh;
top:0;
width:300px;
padding:10px;
padding-right:30px;
text-transform:uppercase;
letter-spacing:2px;
}
.sidebar__slide {
padding-bottom:10px;
opacity: 0.5;
}
.active {
opacity:1;
}
.clock {
display:flex;
flex-direction:row;
justify-content:center;
position:fixed;
height:20px;
bottom:0;
width:100vw;
padding:10px 10px 50px;
text-transform:uppercase;
letter-spacing:2px;
opacity: 0.5;
}
.progress-bg {
background:#000;
display:flex;
flex-direction:row;
justify-content:center;
position:fixed;
height:20px;
bottom:0;
width:100vw;
padding:10px 0;
text-transform:uppercase;
letter-spacing:2px;
opacity: 1.0;
z-index:10;
}
.progress {
background:#fff;
display:flex;
flex-direction:row;
justify-content:center;
position:fixed;
height:20px;
bottom:0;
width:0vw;
padding:10px 0;
text-transform:uppercase;
letter-spacing:2px;
opacity: 0.2;
z-index:20;
}
.marker {
display:flex;
flex-direction:row;
justify-content:center;
position:fixed;
height:20px;
bottom:0;
width:1px;
left:50vw;
padding:10px 0;
background:rgba(255,255,255,0.12);
z-index:20;
}
.marker-active {
background:rgba(255,255,255,0.7);
}
</style>

</head>
<body>
<?php 
$slides = [
    "Intro", 
    "Propaganda",
    "Postfordism",
    "Problems",
    "Anti-Political",
    "Defense Mechanisms",
    "Mental Illness",
    "What doesn't work",
    "Solutions",
    "Random Truths",
    "My Thoughts"
];

$slide_div = "<div id='slide_%s' class='slide'>%s</div>\n";
$sidebar_slide_div = "<div id='sidebar__slide_%s' class='sidebar__slide'>%s</div>\n";
printf($sidebar_div, $sidebar_slide_html);



foreach($slides as $ndx => $slide) {
    printf($slide_div, $ndx, $slide);
}

?>


<div class='sidebar'>
<?php foreach($slides as $ndx => $slide) {
    printf($sidebar_slide_div, $ndx, $slide);
} ?>
</div>
<div class="clock" id="clock">
</div>
    <div class="progress" id="progress"></div>
    <?php foreach($slides as $ndx => $slide) {
        printf("<div id='marker_%s' class='marker' style='left:%svw'></div>", $ndx, (100 / count($slides)) * ($ndx+1) );
    } ?>
<div class="progress-bg">
</div>
<script>
function get(id) {return document.getElementById(id);}
var slide_count = <?= count($slides) ?>;
var State = {
    active_slide : 0
};

window.onscroll = function (e) {
    var y = window.pageYOffset;

    for (var i = 0; i < slide_count; ++i) {
        var slide_el_bound = get('slide_'+i).getBoundingClientRect();
        if (slide_el_bound.top > -window.innerHeight/2 && slide_el_bound.bottom < window.innerHeight* 1.5 ) {
            get('sidebar__slide_'+ i).classList.add("active");
            get('marker_'+ i).classList.add("marker-active");
        } else {
            get('sidebar__slide_'+ i).classList.remove("active");
            get('marker_'+ i).classList.remove("marker-active");
        }
    }
}



var end = Date.now();
var start = end;
end += 1000*60 * 20;
var total = end - start;
setInterval(function() {
    var now = Date.now();
    var delta = end - now; // milliseconds elapsed since start
    var passed = now- start;
    var width = ((passed / total) * 100);
    console.log(passed, total, width);
    get('progress').style.width = width + "vw";
    var minutes =  Math.floor((delta / 1000)/60)
    var seconds =  Math.floor((delta / 1000)%60)
    if (seconds < 10 && seconds > -10) seconds = "0" + seconds;
    if (seconds >= 0 ){
        get('clock').innerText = minutes  + ":" +seconds; // in seconds
    }
}, 100); // update about every second


</script>
</body>
</html>
