<template>
    <div class="col-md-12">
        <slider animation="fade" height="550px" :control-btn=false :speed=800 :interval=5000>
            <slider-item>
                <section class="slider-inner">
                    <a href="#" class="img-hover-enlarge">
                        <img src="https://pan.baidu.com/static/images/16new/bg1.jpg" alt="">
                    </a>
                    <div class="banner-slogan">
                        <p>多端并用</p>
                        <p>数据随身携带</p>
                    </div>
                </section>
            </slider-item>
            <!--<slider-item>-->
            <!--<section class="slider-img">-->
            <!--<a href="#" class="img-hover-enlarge">-->
            <!--<img src="https://pan.baidu.com/static/images/16new/bg2.jpg" alt="">-->
            <!--</a>-->
            <!--<div class="banner-slogan">-->
            <!--<p><span class="left-quote"></span><span>好友分享</span></p>-->
            <!--<p><span>共度美好时光</span><span class="right-quote"></span></p>-->
            <!--</div>-->
            <!--</section>-->
            <!--</slider-item>-->
            <div class="scan-login">
                asfd
            </div>
        </slider>
    </div>
</template>

<script>
    import {Slider, SliderItem} from 'vue-easy-slider'

    export default {
        components: {
            Slider,
            SliderItem
        }
    }
</script>

<style>
    .slider-inner img {
        width: 100%;
        overflow: hidden;
    }

    .banner-slogan {
        position: absolute;
        left: 10%;
        bottom: 10%;
        font-size: 3rem;
        color: #fff;
    }

    .scan-login {
        position: absolute;
        bottom: 10%;
        right: 10%;
        z-index: 99;
    }
</style>