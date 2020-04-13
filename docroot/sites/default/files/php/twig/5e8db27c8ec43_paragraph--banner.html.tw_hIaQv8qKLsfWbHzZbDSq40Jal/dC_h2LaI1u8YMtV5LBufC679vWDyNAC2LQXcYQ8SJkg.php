<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/custom/twelve_carnation/templates/paragraph/paragraph--banner.html.twig */
class __TwigTemplate_1ed5f978cd5a29b3e097ac72f1e2ef925d0c8aa95bca2f23ddcb7fbe61ce1b75 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 40, "if" => 50];
        $filters = ["clean_class" => 42, "escape" => 50];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['clean_class', 'escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 40
        $context["classes"] = [0 => "paragraph", 1 => ("paragraph--type--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute(        // line 42
($context["paragraph"] ?? null), "bundle", [])))), 2 => ((        // line 43
($context["view_mode"] ?? null)) ? (("paragraph--view-mode--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["view_mode"] ?? null))))) : ("")), 3 => "banner", 4 => "banner--large"];
        // line 48
        $context["color"] = ("#" . $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_prgf_color", []), "#items", [], "array"), "entity", []), "field_color", []), "value", [])));
        // line 49
        echo "
<div";
        // line 50
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
        echo " ";
        if ( !twig_test_empty(($context["color"] ?? null))) {
            echo " style=\"background-color: ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["color"] ?? null)), "html", null, true);
            echo "\" ";
        }
        echo ">

  ";
        // line 52
        if ( !$this->getAttribute($this->getAttribute(($context["paragraph"] ?? null), "field_prgf_image", []), "isEmpty", [], "method")) {
            // line 53
            echo "    <div class=\"banner-bg\" style=\"background: url('";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "image_path", [])), "html", null, true);
            echo "') center center; background-size: cover;\">
      <span></span>
    </div>
  ";
        }
        // line 57
        echo "
  <div class=\"banner-cta d-block d-lg-flex\">
    <div class=\"banner-cta-content container align-items-center m-auto py-5 text-center text-white\">
      <div class=\"banner-cta-section\">

        ";
        // line 62
        if ( !$this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_prgf_headline", []), "isEmpty", [], "method")) {
            // line 63
            echo "        <h1 class=\"banner-title text-uppercase mb-4 text-white\">
          ";
            // line 64
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_prgf_headline", [])), "html", null, true);
            echo "
        </h1>
        ";
        }
        // line 67
        echo "
        ";
        // line 68
        if ( !$this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_prgf_description", []), "isEmpty", [], "method")) {
            // line 69
            echo "        <div class=\"banner-description mb-3 text-white\">
          ";
            // line 70
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_prgf_description", [])), "html", null, true);
            echo "
        </div>
        ";
        }
        // line 73
        echo "
        ";
        // line 74
        if ( !$this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_prgf_link", []), "isEmpty", [], "method")) {
            // line 75
            echo "          ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_prgf_link", [])), "html", null, true);
            echo "
        ";
        }
        // line 77
        echo "
      </div>
    </div>
  </div>

</div>


";
    }

    public function getTemplateName()
    {
        return "themes/custom/twelve_carnation/templates/paragraph/paragraph--banner.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  128 => 77,  122 => 75,  120 => 74,  117 => 73,  111 => 70,  108 => 69,  106 => 68,  103 => 67,  97 => 64,  94 => 63,  92 => 62,  85 => 57,  77 => 53,  75 => 52,  64 => 50,  61 => 49,  59 => 48,  57 => 43,  56 => 42,  55 => 40,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/twelve_carnation/templates/paragraph/paragraph--banner.html.twig", "/var/www/docroot/themes/custom/twelve_carnation/templates/paragraph/paragraph--banner.html.twig");
    }
}
