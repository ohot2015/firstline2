<?php

/* base.html.twig */
class __TwigTemplate_3160fa698d9c816869dd46c19c38f148629b22f388e2801311750f414f64e056 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'body' => array($this, 'block_body'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\"
          content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <meta name=\"yandex-verification\" content=\"40deee5724bb5dd7\" />
    <!-- bower:css -->
    <link rel=\"stylesheet\" href=\"bower_components/fotorama/fotorama.css\" />
    <link rel=\"stylesheet\" href=\"bower_components/normalize-css/normalize.css\" />
    <link rel=\"stylesheet\" href=\"bower_components/owl.carousel/dist/assets/owl.carousel.css\" />
    <link rel=\"stylesheet\" href=\"bower_components/owl.carousel/dist/assets/owl.theme.default.css\" />
    <link rel=\"stylesheet\" href=\"bower_components/lightbox2/dist/css/lightbox.css\" />
    <link rel=\"stylesheet\" href=\"bower_components/fancybox/dist/jquery.fancybox.min.css\" />
    <!-- endbower -->
    <link rel=\"icon\" type=\"image/x-icon\" href=\"favicon.ico\">
    <link rel=\"stylesheet\" href=\"web/dist/main.css\">
    <title>Первая линия</title>
</head>
<body>
";
        // line 21
        $this->displayBlock('body', $context, $blocks);
        // line 23
        echo "<!-- Yandex.Metrika counter -->
<script type=\"text/javascript\" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter48141062 = new Ya.Metrika({
                    id:48141062,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName(\"script\")[0],
            s = d.createElement(\"script\"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = \"text/javascript\";
        s.async = true;
        s.src = \"https://mc.yandex.ru/metrika/watch.js\";

        if (w.opera == \"[object Opera]\") {
            d.addEventListener(\"DOMContentLoaded\", f, false);
        } else { f(); }
    })(document, window, \"yandex_metrika_callbacks\");
</script>
<noscript><div><img src=\"https://mc.yandex.ru/watch/48141062\" style=\"position:absolute; left:-9999px;\" alt=\"\" /></div></noscript>
<!-- bower:js -->
<script src=\"bower_components/jquery/dist/jquery.js\"></script>
<script src=\"bower_components/fotorama/fotorama.js\"></script>
<script src=\"bower_components/owl.carousel/dist/owl.carousel.js\"></script>
<script src=\"bower_components/lightbox2/dist/js/lightbox.js\"></script>
<script src=\"bower_components/fancybox/dist/jquery.fancybox.min.js\"></script>
<!-- endbower -->
<!-- <script src=\"//yastatic.net/es5-shims/0.0.2/es5-shims.min.js\"></script> -->
<script src=\"https://api-maps.yandex.ru/2.1/?lang=ru_RU\" type=\"text/javascript\"></script>

<script src=\"web/dist/main-bundle.js\"></script>
";
        // line 62
        $this->displayBlock('script', $context, $blocks);
        // line 63
        echo "</body>
</html>
";
    }

    // line 21
    public function block_body($context, array $blocks = array())
    {
    }

    // line 62
    public function block_script($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  103 => 62,  98 => 21,  92 => 63,  90 => 62,  49 => 23,  47 => 21,  25 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\"
          content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <meta name=\"yandex-verification\" content=\"40deee5724bb5dd7\" />
    <!-- bower:css -->
    <link rel=\"stylesheet\" href=\"bower_components/fotorama/fotorama.css\" />
    <link rel=\"stylesheet\" href=\"bower_components/normalize-css/normalize.css\" />
    <link rel=\"stylesheet\" href=\"bower_components/owl.carousel/dist/assets/owl.carousel.css\" />
    <link rel=\"stylesheet\" href=\"bower_components/owl.carousel/dist/assets/owl.theme.default.css\" />
    <link rel=\"stylesheet\" href=\"bower_components/lightbox2/dist/css/lightbox.css\" />
    <link rel=\"stylesheet\" href=\"bower_components/fancybox/dist/jquery.fancybox.min.css\" />
    <!-- endbower -->
    <link rel=\"icon\" type=\"image/x-icon\" href=\"favicon.ico\">
    <link rel=\"stylesheet\" href=\"web/dist/main.css\">
    <title>Первая линия</title>
</head>
<body>
{% block body %}
{% endblock %}
<!-- Yandex.Metrika counter -->
<script type=\"text/javascript\" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter48141062 = new Ya.Metrika({
                    id:48141062,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName(\"script\")[0],
            s = d.createElement(\"script\"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = \"text/javascript\";
        s.async = true;
        s.src = \"https://mc.yandex.ru/metrika/watch.js\";

        if (w.opera == \"[object Opera]\") {
            d.addEventListener(\"DOMContentLoaded\", f, false);
        } else { f(); }
    })(document, window, \"yandex_metrika_callbacks\");
</script>
<noscript><div><img src=\"https://mc.yandex.ru/watch/48141062\" style=\"position:absolute; left:-9999px;\" alt=\"\" /></div></noscript>
<!-- bower:js -->
<script src=\"bower_components/jquery/dist/jquery.js\"></script>
<script src=\"bower_components/fotorama/fotorama.js\"></script>
<script src=\"bower_components/owl.carousel/dist/owl.carousel.js\"></script>
<script src=\"bower_components/lightbox2/dist/js/lightbox.js\"></script>
<script src=\"bower_components/fancybox/dist/jquery.fancybox.min.js\"></script>
<!-- endbower -->
<!-- <script src=\"//yastatic.net/es5-shims/0.0.2/es5-shims.min.js\"></script> -->
<script src=\"https://api-maps.yandex.ru/2.1/?lang=ru_RU\" type=\"text/javascript\"></script>

<script src=\"web/dist/main-bundle.js\"></script>
{% block script %}{% endblock %}
</body>
</html>
", "base.html.twig", "/var/www/firstline2/template/base.html.twig");
    }
}
