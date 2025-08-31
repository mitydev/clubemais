

<div class="highlight">
    <div class="plus">
        <img src="{{asset('images/badge/plusinverse.svg')}}" alt="">
    </div>
    <img draggable="false" class="absolute top-0 right-0 left-0 bottom-0" style="opacity: 0.36"  src="{{asset('images/highlight-comp.png')}}" alt="">
    <svg width="0" height="0">
        <defs>
            <clipPath id="card-shape" clipPathUnits="objectBoundingBox">
                <path d="M0.002 0.092C0.002 0.043 0.034 0.002 0.072 0.002H0.763C0.801 0.002 0.833 0.043 0.833 0.092V0.123C0.833 0.172 0.864 0.211 0.902 0.211H0.929C0.967 0.211 0.998 0.252 0.998 0.301V0.907C0.998 0.956 0.967 0.998 0.929 0.998H0.536C0.5 0.998 0.464 0.946 0.428 0.946H0.072C0.034 0.946 0.002 0.905 0.002 0.856V0.092Z"/>
            </clipPath>
        </defs>
    </svg>
    <div style="z-index: 1">
        {{$slot}}
    </div>
</div>

<style>
    .highlight .plus {
        position: absolute;
        top: -15px;
        z-index: 1;
        right: -5px;
    }

    .highlight h3{
        font-size: 40px;
    }
    .highlight h1{
        font-size: 64px;
        margin: 0 0 30px 0;
    }
    .highlight {
        position: relative;
        width: 484px;
        height: 406px;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        /*background: rgba(244, 110, 0, .36);*/

        /*clip-path: url(#card-shape);*/
        backdrop-filter: blur(6px);
        padding: 25px;
        color: white;
        font-weight: bold;
    }
</style>

