<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo get_bloginfo('name') ?></title>

    <style>
	    /*  reset https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css */
	    html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}table{border-collapse:collapse;border-spacing:0}

	    body, html {
            font-size: 20px;
            height: 100%;
        }

        body {
            background: #999;
            display: flex;
            flex-direction: column;
        }

        #phone {
            background: #000;
            background: linear-gradient(
                    135deg
                    ,#000 0%,#555 50%,#000 100%);
            box-shadow: 0.3rem 0.3rem 0.6rem 0.3rem #777;
            border-radius: 1.382rem;
            display: flex;
            flex-direction: column;
            margin: 2rem auto;
            width: 45vh;
        }

        #header-wrapper,
        #footer-wrapper {
            padding-bottom: 20%;
            position: relative;
        }

        #header, #footer {
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #header:before, #footer:before {
            background: #fff;
            background: linear-gradient(
                    135deg
                    ,#ffffff10 0%,#ffffff80 80%);
            border: 1px solid #ffffffc0;
            content: '';
            display: block;
            opacity: 0.5;
        }

        #header:before {
            border-radius: 0.382rem;
            height: 10%;
            width: 20%;
        }

        #footer:before {
            border-radius: 50%;
            width: 12%;
            padding-bottom: 12%;
        }

        #iframe-wrapper {
            border: 1px solid #666;
            box-shadow: 0 0 1rem #444;
            border-radius: 0.382rem;
            padding-bottom: 156.25%;
            margin: 0 3%;
            position: relative;
        }

        #iframe {
            border-radius: 0.382rem;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            position: absolute;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
<div id="phone">
    <div id="header-wrapper">&nbsp;
        <div id="header"></div>
    </div>
    <div id="iframe-wrapper">&nbsp;
        <iframe id="iframe" src="<?php echo esc_attr( get_query_var( 'sitedemo_url' ) ) ?>"></iframe>
    </div>
    <div id="footer-wrapper">&nbsp;
        <div id="footer"></div>
    </div>
</div>
<?php include 'partials/menu.php' ?>
</body>
</html>
