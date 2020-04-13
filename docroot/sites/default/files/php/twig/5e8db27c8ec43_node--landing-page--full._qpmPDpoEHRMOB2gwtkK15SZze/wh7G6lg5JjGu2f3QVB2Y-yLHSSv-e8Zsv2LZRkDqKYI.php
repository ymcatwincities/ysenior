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

/* profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/node/node--landing-page--full.html.twig */
class __TwigTemplate_cfd49a9d43f6740f060504a9921151b5b8639fe37713d19932fd053ba5750038 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 71, "if" => 84, "include" => 85];
        $filters = ["clean_class" => 73, "escape" => 92, "trim" => 99, "render" => 99];
        $functions = ["path" => 84, "attach_library" => 92];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'include'],
                ['clean_class', 'escape', 'trim', 'render'],
                ['path', 'attach_library']
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
        // line 69
        echo "
";
        // line 71
        $context["content_classes"] = [0 => "landing-content", 1 => \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(        // line 73
($context["node"] ?? null), "field_lp_layout", []), "value", [])))];
        // line 76
        echo "
";
        // line 78
        $context["sidebar_classes"] = [0 => "landing-sidebar"];
        // line 82
        echo "
";
        // line 84
        if (twig_in_filter("/camps/", $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getPath("entity.node.canonical", ["node" => $this->getAttribute(($context["node"] ?? null), "id", [])]))) {
            // line 85
            echo "  ";
            $this->loadTemplate("@openy_carnation/node/include/header-default--camp.html.twig", "profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/node/node--landing-page--full.html.twig", 85)->display($context);
        } else {
            // line 87
            echo "  ";
            // line 88
            echo "  ";
            $this->loadTemplate("@openy_carnation/node/include/header-default.html.twig", "profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/node/node--landing-page--full.html.twig", 88)->display($context);
        }
        // line 90
        echo "
";
        // line 91
        if (($this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_lp_layout", []), "value", []) == "two_column_fixed")) {
            // line 92
            echo "  ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("openy_carnation/landing"), "html", null, true);
            echo "
";
        }
        // line 94
        echo "
";
        // line 95
        if (($this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_lp_layout", []), "value", []) != "one_column_clean")) {
            // line 96
            echo "<div class=\"container\">
";
        }
        // line 98
        echo "
  ";
        // line 99
        if ( !twig_test_empty(twig_trim_filter($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["content"] ?? null), "field_content", []))))) {
            // line 100
            echo "    <article";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["content_classes"] ?? null)], "method")), "html", null, true);
            echo ">

      ";
            // line 102
            if ((($this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_lp_layout", []), "value", []) == "two_column") || ($this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_lp_layout", []), "value", []) == "two_column_fixed"))) {
                // line 103
                echo "      <div class=\"two-column row\">
        <div class=\"main-region col-lg-7 col-xl-8\">
          ";
            }
            // line 106
            echo "          ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_content", [])), "html", null, true);
            echo "
          ";
            // line 107
            if ((($this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_lp_layout", []), "value", []) == "two_column") || ($this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_lp_layout", []), "value", []) == "two_column_fixed"))) {
                // line 108
                echo "        </div>
        <div class=\"sidebar-region col-lg-5 col-xl-4\">
          ";
            }
            // line 111
            echo "          <article";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["sidebar_classes"] ?? null)], "method")), "html", null, true);
            echo ">
            ";
            // line 112
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_sidebar_content", [])), "html", null, true);
            echo "
          </article>
          ";
            // line 114
            if ((($this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_lp_layout", []), "value", []) == "two_column") || ($this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_lp_layout", []), "value", []) == "two_column_fixed"))) {
                // line 115
                echo "        </div>
      </div>
      ";
            }
            // line 118
            echo "
    </article>
  ";
        }
        // line 121
        echo "
";
        // line 122
        if (($this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_lp_layout", []), "value", []) != "one_column_clean")) {
            // line 123
            echo "</div>
";
        }
        // line 125
        echo "
";
        // line 126
        if (($this->getAttribute(($context["content"] ?? null), "field_bottom_content", [], "any", true, true) &&  !twig_test_empty(twig_trim_filter($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["content"] ?? null), "field_bottom_content", [])))))) {
            // line 127
            echo "<div id=\"bottom-region\">
  ";
            // line 128
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_bottom_content", [])), "html", null, true);
            echo "
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/node/node--landing-page--full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 128,  167 => 127,  165 => 126,  162 => 125,  158 => 123,  156 => 122,  153 => 121,  148 => 118,  143 => 115,  141 => 114,  136 => 112,  131 => 111,  126 => 108,  124 => 107,  119 => 106,  114 => 103,  112 => 102,  106 => 100,  104 => 99,  101 => 98,  97 => 96,  95 => 95,  92 => 94,  86 => 92,  84 => 91,  81 => 90,  77 => 88,  75 => 87,  71 => 85,  69 => 84,  66 => 82,  64 => 78,  61 => 76,  59 => 73,  58 => 71,  55 => 69,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/node/node--landing-page--full.html.twig", "/var/www/docroot/profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/node/node--landing-page--full.html.twig");
    }
}
