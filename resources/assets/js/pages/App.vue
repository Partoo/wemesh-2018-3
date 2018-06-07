<template>
    <div>
        <header class="row sticky-menu" id="sticky">
            <div class="col-md-3">
                <a href="#" class="logo"><span class="header-logo hidden-sm">
                <img src="/img/logo.png" alt="">
            </span></a>
                <label for="drawer-checkbox" class="button drawer-toggle"></label>
            </div>
            <div class="col-sm-12 col-md-5 col-md-offset-4">
                <div class="logo-title" v-scroll-spy-active v-scroll-spy-link>
                    <a v-for="item in menus" href="#" class="button hidden-sm">{{item}}</a>
                </div>
            </div>
        </header>
        <input type="checkbox" id="drawer-checkbox">
        <nav class="drawer hidden-md hidden-lg">
            <label for="drawer-checkbox" class="close"></label>
            <h4><a href="index.html">Home</a></h4>
            <h4><a href="blog.html">Blog</a></h4>
            <h4><a href="contact.html">Contact</a></h4>
        </nav>
        <div class="main" v-scroll-spy="{data: 'section', offset: 69, time: 300, steps: 30}">
            <div class="row">
                <carousel></carousel>
            </div>
            <div class="row">
                <div class="col-md-12" id="products">
                    <div class="section-title text-center mb-30 ">
                        <h2>About <span>US</span></h2>
                        <p><span>Lorem</span> ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                            incididunt ametfh consectetur dolore magna aliqua.</p>
                        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non nostrum quo sed totam.
                            Aperiam asperiores aut deleniti dicta eius facere hic, in magni, odit provident quas
                            quibusdam, reprehenderit repudiandae voluptatem!
                        </div>
                        <div>A accusamus accusantium aliquam autem blanditiis, consequatur, cumque dolore eius explicabo
                            fugiat id impedit in iste laborum laudantium libero modi odio quaerat quasi quod reiciendis
                            rerum tempore, unde voluptas voluptatibus.
                        </div>
                        <div>Aliquid ipsa iste nobis odit praesentium! Accusantium dignissimos dolore, esse est harum
                            nisi numquam quam quas quisquam quos, totam vel velit voluptas! Alias commodi culpa eveniet
                            exercitationem fuga iure maxime.
                        </div>
                        <div>Alias aliquid corporis deleniti dolore eos, exercitationem facere fuga laborum, libero
                            maiores minus molestias mollitia necessitatibus, quo unde! A ad beatae cumque distinctio
                            dolorem dolorum est minus natus porro totam!
                        </div>
                        <div>Aperiam asperiores eligendi expedita facilis illum, iusto maiores mollitia neque quo vitae?
                            Aperiam, at aut eos fuga itaque iure praesentium sed sint totam veritatis. Aliquam beatae
                            cum fuga obcaecati odit.
                        </div>
                        <div>Accusantium aliquid beatae distinctio et in ipsam laborum magnam, nostrum odio odit?
                            Asperiores aspernatur debitis deleniti enim harum placeat quasi recusandae saepe, sequi
                            voluptatum! A ab aut dolorem facilis repudiandae?
                        </div>
                        <div>Commodi eum facilis nihil quis. Ab adipisci alias, amet aspernatur atque cupiditate
                            dolores, ducimus enim eos, exercitationem in laborum molestiae mollitia odio odit officia
                            porro praesentium ratione recusandae reiciendis sunt.
                        </div>
                        <div>Accusantium debitis dolorum et ipsam, laudantium quae quas qui sint? Aperiam, atque
                            delectus doloribus eos est fuga inventore, ipsam minus, molestias numquam odio pariatur
                            provident quisquam saepe sed soluta vero.
                        </div>
                        <div>Deleniti ducimus enim esse iure perspiciatis quos repudiandae totam. Autem consequatur
                            deserunt dicta distinctio hic, illo inventore iure laudantium neque omnis quibusdam repellat
                            repellendus? Cumque eius id iusto natus quidem!
                        </div>
                        <div>Ad dicta distinctio doloremque ducimus earum eligendi facilis, illum itaque natus nesciunt
                            non nulla possimus quae repellendus similique tempore voluptatem. Aperiam cumque doloremque
                            ipsum provident quae quo recusandae rem totam!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Carousel from '../components/Carousel'

    export default {
        data() {
            return {
                section: 0,
                menus: [
                    '首页', '产品介绍', '应用市场', '关于我们'
                ]
            }
        },
        components: {
            Carousel
        }
    }
</script>