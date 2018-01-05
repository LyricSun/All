<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /*                                    */
        /*  Styles for Calligraphy Animation  */
        /*                                    */
        @-webkit-keyframes stroke {
            from {
                stroke-dashoffset: 120%;
            }
            to {
                stroke-dashoffset: 0;
            }
        }
        @keyframes stroke {
            from {
                stroke-dashoffset: 120%;
            }
            to {
                stroke-dashoffset: 0;
            }
        }
        @-webkit-keyframes bleed {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes bleed {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        #container {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100vw;
            height: 100vh;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            background: #F3F3F3;
        }

        #calligraphy {
            width: 100vmin;
            height: auto;
            padding: 0 10vw;
        }

        .stroke, .stroke--thin, .stroke--eraser {
            fill: none;
            stroke: #222833;
            stroke-width: 45;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-miterlimit: 10;
            stroke-dasharray: 120%;
            stroke-dashoffset: 120%;
        }
        .stroke--thin {
            stroke-width: 20;
        }

        .bleed {
            fill: #222833;
            opacity: 0;
        }

        .animate #h-stroke-1 {
            -webkit-animation: stroke 1s ease 0.5s forwards;
            animation: stroke 1s ease 0.5s forwards;
        }
        .animate #h-stroke-2 {
            -webkit-animation: stroke 1s ease 0.86s forwards;
            animation: stroke 1s ease 0.86s forwards;
        }
        .animate #h-bleed-1, .animate #h-bleed-2 {
            -webkit-animation: bleed 1ms ease 1.07s forwards;
            animation: bleed 1ms ease 1.07s forwards;
        }
        .animate #h-bleed-3, .animate #h-bleed-4 {
            -webkit-animation: bleed 1ms ease 1.11s forwards;
            animation: bleed 1ms ease 1.11s forwards;
        }
        .animate #h-stroke-3 {
            -webkit-animation: stroke 1s ease 1.5s forwards;
            animation: stroke 1s ease 1.5s forwards;
        }
        .animate #h-bleed-5 {
            -webkit-animation: bleed 1ms ease 1.54s forwards;
            animation: bleed 1ms ease 1.54s forwards;
        }
        .animate #i-stroke-1 {
            -webkit-animation: stroke 1s ease 2.2s forwards;
            animation: stroke 1s ease 2.2s forwards;
        }
        .animate #i-bleed-1 {
            -webkit-animation: bleed 1ms ease 2.38s forwards;
            animation: bleed 1ms ease 2.38s forwards;
        }
        .animate #i-bleed-2 {
            -webkit-animation: bleed 1ms ease 2.4s forwards;
            animation: bleed 1ms ease 2.4s forwards;
        }
        .animate #i-stroke-2 {
            -webkit-animation: stroke 1s ease 2.6s forwards;
            animation: stroke 1s ease 2.6s forwards;
        }
        .animate #x-stroke-1 {
            -webkit-animation: stroke 1s ease 3s forwards;
            animation: stroke 1s ease 3s forwards;
        }
        .animate #x-stroke-2 {
            -webkit-animation: stroke 1s ease 3.26s forwards;
            animation: stroke 1s ease 3.26s forwards;
        }
        .animate #x-bleed-1 {
            -webkit-animation: bleed 1ms ease 3.48s forwards;
            animation: bleed 1ms ease 3.48s forwards;
        }
        .animate #x-bleed-2 {
            -webkit-animation: bleed 1ms ease 3.5s forwards;
            animation: bleed 1ms ease 3.5s forwards;
        }
        .animate #x-stroke-3 {
            -webkit-animation: stroke 1s ease 3.7s forwards;
            animation: stroke 1s ease 3.7s forwards;
        }

        /*                                                  */
        /*  Extra Styles for Redo Button & Animation Reset  */
        /*                                                  */
        @-webkit-keyframes redo {
            from {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            to {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes redo {
            from {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            to {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-webkit-keyframes btn {
            from {
                opacity: 0;
                cursor: auto;
                pointer-events: none;
            }
            to {
                opacity: 1;
                cursor: pointer;
                pointer-events: auto;
            }
        }
        @keyframes btn {
            from {
                opacity: 0;
                cursor: auto;
                pointer-events: none;
            }
            to {
                opacity: 1;
                cursor: pointer;
                pointer-events: auto;
            }
        }
        @-webkit-keyframes fadeout {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
        @keyframes fadeout {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
        @-webkit-keyframes eraser {
            from {
                stroke-dashoffset: 1000%;
            }
            99% {
                opacity: 1;
            }
            to {
                stroke-dashoffset: 0;
                opacity: 0;
            }
        }
        @keyframes eraser {
            from {
                stroke-dashoffset: 1000%;
            }
            99% {
                opacity: 1;
            }
            to {
                stroke-dashoffset: 0;
                opacity: 0;
            }
        }
        .stroke--eraser {
            stroke: #F3F3F3;
            stroke-width: 50;
            stroke-dasharray: 1000%;
            stroke-dashoffset: 1000%;
        }

        #redo {
            position: absolute;
            top: 20px;
            left: 20px;
            height: 40px;
            width: 40px;
        }
        #redo svg {
            width: 100%;
            height: auto;
        }
        #redo svg:hover, #redo svg:focus {
            -webkit-animation: redo 800ms ease infinite;
            animation: redo 800ms ease infinite;
        }
        #redo path {
            fill: #3EC3A3;
        }
        #redo.animate {
            -webkit-animation: btn 400ms ease 4.5s forwards;
            animation: btn 400ms ease 4.5s forwards;
            opacity: 0;
            cursor: auto;
            pointer-events: none;
        }
        #redo.hidden {
            opacity: 0;
            cursor: auto;
            pointer-events: none;
            -webkit-animation: fadeout 400ms ease forwards;
            animation: fadeout 400ms ease forwards;
        }

        .animate #e-stroke {
            -webkit-animation: eraser 5s ease 0s 1;
            animation: eraser 5s ease 0s 1;
        }

        @media screen\0 {
            .stroke, .stroke--thin, .stroke--eraser, .bleed {
                stroke-dasharray: 0;
                stroke-dashoffset: 0;
                opacity: 1;
                -webkit-animation: none;
                animation: none;
            }

            #redo, .stroke--eraser {
                opacity: 0;
            }
        }
        @supports (-ms-ime-align: auto) {
            .stroke, .stroke--thin, .stroke--eraser, .bleed {
                stroke-dasharray: 0;
                stroke-dashoffset: 0;
                opacity: 1;
                -webkit-animation: none;
                animation: none;
            }

            #redo, .stroke--eraser {
                opacity: 0;
            }
        }
    </style>
</head>
<body>
<div id="container">
    <a id="redo" class="animate">
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
            <path id="redo" d="M11 1.833V4.75a.4.4 0 0 1-.124.292.4.4 0 0 1-.293.124H7.667c-.183 0-.31-.086-.385-.26a.37.37 0 0 1 .09-.45l.9-.898c-.642-.594-1.4-.89-2.272-.89a3.24 3.24 0 0 0-1.292.263A3.31 3.31 0 0 0 2.93 4.71 3.24 3.24 0 0 0 2.666 6c0 .45.088.88.264 1.29.176.41.414.767.713 1.065.3.3.654.537 1.065.713.41.177.84.266 1.292.266a3.27 3.27 0 0 0 1.465-.34c.46-.225.848-.544 1.165-.957.03-.043.08-.07.15-.077.064 0 .12.02.162.058l.892.898c.04.035.06.08.063.134a.214.214 0 0 1-.05.146 4.9 4.9 0 0 1-1.718 1.332A4.964 4.964 0 0 1 6 11a4.877 4.877 0 0 1-1.94-.397 5.05 5.05 0 0 1-1.595-1.067c-.447-.448-.803-.98-1.068-1.596S1 6.677 1 6c0-.676.132-1.324.397-1.94a5.057 5.057 0 0 1 1.068-1.595A5.07 5.07 0 0 1 4.06 1.397 4.86 4.86 0 0 1 6 1a5.055 5.055 0 0 1 3.445 1.38l.846-.84c.127-.135.28-.165.456-.09a.39.39 0 0 1 .254.383"/>
        </svg>
    </a>
    <svg id="calligraphy" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="440" height="265" viewBox="0 0 440 265">
        <g id="hi" class="animate">
            <defs>
                <path id="h1-shape" d="M154.23 27.21c-1.946 2.415-5.418 1.835-7.25-.73-3.312-4.63-15.134 14.07-27.182 50.23-16.137 48.435-43.945 153.282-52.153 177.263-4.452 13.008-42.214 13.06-39.107.076 4.723-19.737 25.042-95.183 45.608-155.64 21.5-63.195 41.05-115.997 74.105-90.7 2.215 1.696 3.91 4.136 5.112 7.183 0 0 3.283 9.318.867 12.318z"/>
                <path id="h2-shape" d="M148.252 7.71C172.246 26.075 135.064 131.9 76.598 150.9c-61.904 20.12-92.495-25.09-64.125-58.523 1.787-2.106 2.77-1.513 2.257 1.2-6.865 36.437 27.307 57.933 59.72 49.134 45.86-12.448 71.094-72.394 73.253-110.464.242-4.26-.442-6.37-1.824-6.488-1.15-.1-4.985-2.38-3.9-10.463 1.367-10.205 6.272-7.584 6.272-7.584z"/>
                <path id="h3-shape" d="M84.368 165.916s59.68-65.286 89.193-55.538c22.418 7.403 16.916 29.663 13.853 41.583-3.063 11.923-27.62 98.25.38 98.25 18.126 0 30.977-17.702 39.165-33.84 1.604-3.16 3.916-2.097 2.79.91-7.433 19.86-21.853 43.18-47.61 43.18-92.826 0-8.473-139-30.973-139-19.932 0-55.715 45.538-63.365 63.464l-3.432-19.008z"/>
                <path id="i1-shape" d="M239.86 132.225c-20.05 61.736-37.11 128.236 26.68 128.236 25.755 0 40.177-23.32 47.61-43.18 1.125-3.007-1.188-4.07-2.79-.91-8.19 16.138-21.04 33.84-39.165 33.84-28 0-5.045-81.433 5.967-122.44 3.975-14.798-31.394-16.82-38.302 4.455z"/>
                <path id="i2-shape" d="M297.783 65.637c.81-17.168-9.244-20.64-22.246-11.51-12.88 9.043-30.12 42.117-1.533 41.374 21.957-.572 23.35-20.764 23.78-29.863z"/>
                <path id="x1-shape" d="M438.123 21.947c-.305-4.894-1.727-8.658-4.484-10.973-15.265-12.8-40.37-2.787-60.302 46.255-18.078 44.472-22.916 112.883-20.94 124.904 1.33 8.104 16.927 10.385 19.145-1.125 4.346-22.53 7.945-49.74 28.006-99.218 14.612-36.035 27.903-55.557 31.11-52.232.74.768 2.4 1.15 5.15.15s2.313-7.763 2.313-7.763z"/>
                <path id="x2-shape" d="M430.36 29.332c.98.522 1.298 2.57.8 6.257-4.195 31.095-36.408 88.557-60.523 111.66-3.928 3.525-14.355 12.992-10.215 18.99 2.018 2.924 6.244 1.69 8.17-.672 32.852-43.364 74.844-119.99 69.053-147.25-.283-1.338-3.03-7.42-8.084-1.795-6.062 6.75.362 12.575.8 12.81z"/>
                <path id="x3-shape" d="M343.582 231.3c5.338-12.433 20.797-24.77 28.55-8.722s-1.845 38.654-15.67 36.742c-13.823-1.914-17.433-17.42-12.88-28.02z"/>
            </defs>
            <clipPath id="h1-clip">
                <use xlink:href="#h1-shape" overflow="visible"/>
            </clipPath>
            <clipPath id="h2-clip">
                <use xlink:href="#h2-shape" overflow="visible"/>
            </clipPath>
            <clipPath id="h3-clip">
                <use xlink:href="#h3-shape" overflow="visible"/>
            </clipPath>
            <clipPath id="i1-clip">
                <use xlink:href="#i1-shape" overflow="visible"/>
            </clipPath>
            <clipPath id="i2-clip">
                <use xlink:href="#i2-shape" overflow="visible"/>
            </clipPath>
            <clipPath id="x1-clip">
                <use xlink:href="#x1-shape" overflow="visible"/>
            </clipPath>
            <clipPath id="x2-clip">
                <use xlink:href="#x2-shape" overflow="visible"/>
            </clipPath>
            <clipPath id="x3-clip">
                <use xlink:href="#x3-shape" overflow="visible"/>
            </clipPath>
            <path id="h-stroke-1" clip-path="url(#h1-clip)" class="stroke" d="M41.812 278.21C53.102 228.9 87.475 89.605 118.98 30.046c17.73-33.518 35.767-11.984 35.383 13.342"/>
            <path id="h-stroke-2" clip-path="url(#h2-clip)" class="stroke--thin" d="M138.312 10.71c29.333 3.335 2.448 93-39.938 124.743C61.978 162.71-24.356 159.045 24.31 64.71"/>
            <path id="h-bleed-1" class="bleed" d="M106.128 121.018c-1.877 5.943 1.122 2.383 1.122 2.383l-3.67 4.144 2.548-6.526z"/>
            <path id="h-bleed-2" class="bleed" d="M103.305 135.453s-1.326.338-2.61 4.22l.004-2.712 2.605-1.507z"/>
            <path id="h-bleed-3" class="bleed" d="M55.174 144.48s3.888.508 5.145-3.28l-.8 3.97-4.346-.69z"/>
            <path id="h-bleed-4" class="bleed" d="M53.1 155.682s2.96-.525 2.328 1.568l1.133-2.58-3.46 1.012z"/>
            <path id="h-stroke-3" clip-path="url(#h3-clip)" class="stroke" d="
      M73,193c0,0,20.383-44.539,40.351-67.169C133.319,103.2,147.208,97.582,163.5,107c23.409,13.532,2.324,65.971,0.478,71.711
      c-13.354,41.532-11.978,76.327,13.672,76.327c28.698,0,41.669-16.749,48.993-33.978"/>
            <path id="h-bleed-5" class="bleed" d="M97.61 150.404s-1.042 3.105.764 1.37l-2.223 2.685 1.46-4.056z"/>
            <path id="i-stroke-1" clip-path="url(#i1-clip)" class="stroke" d="M266.645 109.386s-56.992 142.325-4.66 145.15c48.03 2.595 55.994-57.49 55.994-57.49"/>
            <path id="i-bleed-1" class="bleed" d="M219.64 228.898l5.608-4.875-3.53-5.498c.105 7.686-2.077 10.373-2.077 10.373z"/>
            <path id="i-bleed-2" class="bleed" d="M221.823 234.092l2.3-5.193v5.192s-.34-3.154-2.3 0z"/>
            <path id="i-stroke-2" clip-path="url(#i2-clip)" class="stroke" d="M269.742 99.378s10.236-47 35.236-59.667"/>
            <path id="x-stroke-1" clip-path="url(#x1-clip)" class="stroke" d="M359.467 199.38c2.592-31.778 12.95-111.002 39.36-156.67C423.48.08 438.31 12.38 432.643 43.38"/>
            <path id="x-stroke-2" clip-path="url(#x2-clip)" class="stroke--thin" d="M422.31 14.178c38-.8-25.65 125.494-73.33 162.533"/>
            <path id="x-bleed-1" class="bleed" d="M377.82 152.857l-1.66 1.432.05 2.31s.542-2.207 1.61-3.743z"/>
            <path id="x-bleed-2" class="bleed" d="M381.656 133.845l-.87 2.63 1.39-2.064s-.944.98-.52-.565z"/>
            <path id="x-stroke-3" clip-path="url(#x3-clip)" class="stroke" d="M382.176 212.71c-6.53-2.665-52.53 24.478-9.197 59.335"/>
        </g>
        <g id="erase">
            <path id="e-stroke" class="stroke--eraser" d="
  M41.561,5.901C83.374,35.171-16.165,140.336,17.5,174C50.903,209.251,109.982-24.907,156.772,5.901
  C193.028,29.774,9.713,237.518,53.856,261.759S198.502-4.589,238.961,7.41c48.415,14.359-126.37,231.579-81.753,256.349
  S294.786-11.417,338.5,7.41c43.714,18.827-138.181,227.095-81.833,253.09C324.948,292,367.176,3.5,415.5,25.901
  c36.36,16.855-79.5,202.998-45.538,236.494"/>
        </g>
    </svg>
</div>
</body>
<script>
    // Reset the Animation on Button Click:
    const r = $('#redo'),
        e = $('#erase'),
        h = $('#hi'),
        he = $('#hi, #erase')
    r.on('click', function(event) {
        event.preventDefault();
        r.toggleClass('animate hidden');
        setTimeout(function() {
            e.addClass('animate');
            setTimeout(function() {
                he.removeClass('animate');
                setTimeout(function() {
                    h.addClass('animate');
                    r.toggleClass('animate hidden');
                }, 100)
            }, 2400)
        }, 300)
    });
</script>
</html>