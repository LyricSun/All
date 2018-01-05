<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        html,
        body {
            margin: 0;
            overflow: hidden;
            font-family: Arial;
            cursor: pointer;
            background-color: black;
        }

        .note {
            position: absolute;
            color: rgba(249, 241, 204, .5);
            left: 0;
            right: 0;
            bottom: 20px;
            margin: auto;
            text-align: center;
            user-select: none;
            font-family: Arial;
        }
    </style>
</head>
<body>
<canvas id="canvas"></canvas>
<div id="note" class="note"></div>
</body>
<script>
    var canvas  = document.getElementById('canvas');
    ctx = canvas.getContext('2d'),
        WIDTH = 0,
        HEIGHT = 0,
        cells = [],
        population = Math.floor(Math.random()*150)+1;

    var c1 = 43,
        c1S = 1,
        c2 = 205,
        c2S = 1,
        c3 = 255,
        c3S = 1,
        colorspeed1, colorspeed2, colorspeed3,
        maxColor1, maxColor2, maxColor3,
        minColor1, minColor2, minColor3,
        rotations = [0,45,90,180,270],
        rotationAxis,
        iteration = 0,
        maxIteration = 9999,
        baseGCO,
        resetAlpha = 0;

    function initVariables(){
        population = Math.floor(Math.random()*150)+1;
        rotationAxis = rotations[Math.floor(Math.random()*5)];
        colorspeed1 = Math.random()*2;
        colorspeed2 = Math.random()*2;
        colorspeed3 = Math.random()*2;
        maxColor1 = Math.floor(Math.random()*100)+155;
        maxColor2 = Math.floor(Math.random()*100)+155;
        maxColor3 = Math.floor(Math.random()*100)+155;
        minColor1 = Math.floor(Math.random()*100);
        minColor2 = Math.floor(Math.random()*100);
        minColor3 = Math.floor(Math.random()*100);
    }

    initVariables();


    function Cell(id, x, y) {
        this.id = id;
        this.x = x;
        this.y = y;
        this.r = Math.floor(Math.random()*8)+3;
        this.breathingDir = 1;
        this.speed = Math.floor(Math.random()*10)/10;
        this.direction = Math.floor(Math.random()*360);
        this.stepCounter = 0;
        this.changeDirectionFrequency   = getRandomInt(1,200);
        this.turner                     = getRandomInt(0,1) == 0 ? -1 : 1;
        this.turnerAmp                  = getRandomInt(1,2);
        this.a = Math.random()/2;
        this.color = "rgba("+c1+","+c2+","+c3+", "+this.a+")";
        this.style = Math.random() > .5 ? "fill" : "stroke";

    }

    Cell.prototype.move = function() {
        var next_x = this.x + Math.cos(degToRad(this.direction))*this.speed,
            next_y = this.y + Math.sin(degToRad(this.direction))*this.speed;

        // Limites du canvas
        if (next_x >= (WIDTH - this.r)) {
            next_x = WIDTH - this.r;
            this.direction = getRandomInt(90,270,this.direction);
        }
        else if (next_x <= this.r) {
            next_x = this.r;
            var except = [90,270];
            this.direction = getRandomInt(0,360,except);
        }
        if (next_y >= (HEIGHT - this.r)) {
            next_y = HEIGHT - this.r;
            this.direction = getRandomInt(180,360,this.direction);
        }
        else if (next_y <= this.r) {
            next_y = this.r;
            this.direction = getRandomInt(0,180,this.direction);
        }

        this.x = next_x;
        this.y = next_y;

        this.stepCounter++;

        if (this.changeDirectionFrequency && this.stepCounter == this.changeDirectionFrequency ) {
            this.turner *= -1;
            this.turnerAmp = getRandomInt(1,2);
            this.stepCounter = 0;
            this.changeDirectionFrequency = getRandomInt(1,200);
        }

        this.direction+=this.turner*this.turnerAmp;

        this.draw();
    };

    Cell.prototype.draw = function() {
        ctx.translate(WIDTH/2, HEIGHT/2);
        ctx.rotate(degToRad(rotationAxis));
        ctx.translate(-WIDTH/2, -HEIGHT/2);
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.r, 0, 2 * Math.PI, false);
        if (this.style == "fill") {
            ctx.fillStyle = this.color;
            ctx.fill();
        } else {
            ctx.strokeStyle = this.color;
            ctx.stroke();
        }
        ctx.closePath();
        this.color = "rgba("+c1+","+c2+","+c3+","+this.a+")";
    };



    setCanvasSize();

    function setCanvasSize() {
        WIDTH = document.documentElement.clientWidth,
            HEIGHT = document.documentElement.clientHeight;

        canvas.setAttribute("width", WIDTH);
        canvas.setAttribute("height", HEIGHT);
    }

    window.onresize = setCanvasSize;

    function init(){
        defineGCO();
        for (var i = 0; i < population; i++) {
            cells[i] = new Cell(i, WIDTH/2, HEIGHT/2);
        }
        animate();
    }

    function defineGCO() {
        var gco = Math.random();
        if (gco <= 1) ctx.globalCompositeOperation = "lighter";
        if (gco <= .5) ctx.globalCompositeOperation = "soft-light";
        if (gco <= .25) ctx.globalCompositeOperation = "luminosity";
        baseGCO = ctx.globalCompositeOperation;
    }

    init();

    function animate() {
        iteration++;
        requestAnimationFrame(animate);

        for (var i in cells) {
            cells[i].move();
        }

        if (iteration >= maxIteration) {
            ctx.globalCompositeOperation = "source-over";
            ctx.fillStyle = "rgba(0,0,0,"+resetAlpha+")";
            resetAlpha+=.01;
            ctx.fillRect(0,0,WIDTH,HEIGHT);
            ctx.globalCompositeOperation = baseGCO;
        }
        if (resetAlpha > 1.2) {
            reset();
            return;
        }

        changeColor();

    }

    function reset() {
        ctx.clearRect(0,0,WIDTH,HEIGHT);
        resetAlpha = 0;
        defineGCO();
        iteration = 0;
        maxIteration = 9999;
        for (var i = 0; i < population; i++) {
            delete cells[i];
        }
        cells = [];
        initVariables();

        for (var i = 0; i < population; i++) {
            cells[i] = new Cell(i, WIDTH/2, HEIGHT/2);
        }

    }

    function getRandomInt(min, max, except) {
        var i = Math.floor(Math.random() * (max - min + 1)) + min;
        if (typeof except == "undefined") return i;
        else if (typeof except == 'number' && i == except) return getRandomInt(min, max, except);
        else if (typeof except == "object" && (i >= except[0] && i <= except[1])) return getRandomInt(min, max, except);
        else return i;
    }

    function degToRad(deg) {
        return deg * (Math.PI / 180);
    }

    function changeColor(){
        if (c1 <= 0 || c1 >= maxColor1) {
            c1S *= -1;
            if (c1 > maxColor1) c1 = maxColor1;
            if (c1 < minColor1) c1 = minColor1;
        }
        if (c2 <= minColor2 || c2 >= maxColor2) {
            c2S *= -1;
            if (c2 > maxColor2) c2 = maxColor2;
            if (c2 < minColor2) c2 = minColor2;
        }
        if (c3 <= 0 || c3 >= maxColor3) {
            c3S *= -1;
            if (c3 > maxColor3) c3 = maxColor3;
            if (c3 < minColor3) c3 = minColor3;
        }
        c1 += Math.floor(colorspeed1 * c1S);
        c2 += Math.floor(colorspeed2 * c2S);
        c3 += Math.floor(colorspeed3 * c3S);
    }

    document.addEventListener("click", function (e) {
        document.getElementById('note').style.display = "none";
        maxIteration = iteration;
    });
</script>
</html>