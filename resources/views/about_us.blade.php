<!DOCTYPE html>
<html>

<head>
    <title>About Us</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<style>
    body{
        font-family: 'Poppins', sans-serif;
    }

    .about-us{
        padding-top:120px;
        padding-bottom:100px;
    }

    .about-us .about-img{
        width:100%;
        max-width:960px;
        margin:0 auto;
        position:relative;
    }

    .about-us .about-img::after{
        content: '';
        position: absolute;
        width: calc(50% + 80px);
        height: calc(100% + 120px);
        top: -60px;
        left: -60px;
        background: transparent;
        z-index: 0;
        border: 25px solid #79337D;
    }
    
    .about-us .about-img img{
        width:100%;
        height:100%;
        border-radius: 10px;
        position:relative;
        z-index: 5;
    }

    .about-us .about-content{
        padding-top:100px;
        max-width:960px;
        margin: 0 auto;
    }

    .about-content h4{
        font-size:18px;
        color:#79337D;
        margin-bottom:10px !important;
    }
    
    .about-content h3{
        font-size:26px;
        position:relative;
    }

    .about-content h3::before{
        position: absolute;
        content: '';
        left: 0px;
        bottom: -10px;
        width: 50px;
        height: 3px;
        background-color: #79337D;
    }

</style>

<body>

    <!-- <h1>{{ $about_us->title}}</h1>
    <div>
        <?= $about_us->about_us ?>
    </div> -->
    <section class="about-us">
       <div class="container">
           <div class="row">
               <div class="col-xl-12 col-lg-12">
                   <div class="about-img">
                        <img src="http://groundedwellwise.cmexpertiseinfotech.com/assets/about-img.png" alt="">
                   </div>
                   <div class="about-content">
                        <h4>Our Future Goal</h4>
                        <h3>We want to lead in innovation & Technology</h3>
                        <div class="mt-5">
                            <p>We works on UI/UX and functionality as well so that a plugins comes with proper stucture & stunning looks which suits to your web app & website.</p>
                            <p>We take a small toolkit here and ride it well so that it is fit for your use. One who performs well and looks even better.</p>
                            <p>Here we are trying to give you all kinds of technical content, whether it is related to designing or functionality. We are creating content on a lot of languages and will continue to make it free of cost even if you use it without any problem. Which is a very important thing.</p>
                            <p>Here you can also share the content you create, if our technical team likes it, then we will also share it on our blog.</p>
                            <p>In the end, I would say keep visiting our website and enjoy the quality content.</p>
                        </div>
                   </div>
               </div>
           </div>
       </div>
    </section>
    

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>