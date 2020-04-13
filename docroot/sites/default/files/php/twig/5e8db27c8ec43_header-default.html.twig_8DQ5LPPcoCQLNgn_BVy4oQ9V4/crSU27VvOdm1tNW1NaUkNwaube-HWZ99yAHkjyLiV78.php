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

/* @openy_carnation/node/include/header-default.html.twig */
class __TwigTemplate_f8d330c3a8f4549618783a446a9dfadb5e31868c3115d31ea49fca9d971ecb1d extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 14, "if" => 20];
        $filters = ["clean_class" => 16, "trim" => 20, "render" => 20, "escape" => 21];
        $functions = ["drupal_breadcrumb" => 59, "drupal_block" => 61];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['clean_class', 'trim', 'render', 'escape'],
                ['drupal_breadcrumb', 'drupal_block']
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
        // line 12
        echo "
";
        // line 14
        $context["header_classes"] = [0 => "w-100", 1 => \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(        // line 16
($context["node"] ?? null), "field_lp_layout", []), "value", [])))];
        // line 19
        echo "
";
        // line 20
        if ( !twig_test_empty(twig_trim_filter($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["content"] ?? null), "field_header_content", []))))) {
            // line 21
            echo "  <article";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["header_classes"] ?? null)], "method")), "html", null, true);
            echo ">
    <div";
            // line 22
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content_attributes"] ?? null), "addClass", [0 => "content"], "method")), "html", null, true);
            echo ">
      <div class=\"main\">
        ";
            // line 24
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_header_content", [])), "html", null, true);
            echo "
      </div>
    </div>
  </article>
";
        } else {
            // line 29
            echo "  <div class=\"banner banner--small banner--grey\">

    ";
            // line 31
            if ( !twig_test_empty(twig_trim_filter($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(($context["header_image"] ?? null))))) {
                // line 32
                echo "    <div class=\"banner-bg\" style=\"background: url('";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["header_image"] ?? null)), "html", null, true);
                echo "') center center; background-size: cover;\">
      <span></span>
    </div>
    ";
            }
            // line 36
            echo "
    <div class=\"banner-cta d-block d-lg-flex\">
      <div class=\"banner-cta-content container align-items-center m-auto py-4 py-lg-5 text-white\">
        <div class=\"banner-cta-section\">

          ";
            // line 41
            if ( !twig_test_empty(twig_trim_filter($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(($context["label"] ?? null))))) {
                // line 42
                echo "          <h1 class=\"banner-title text-uppercase m-0 text-white\">
            ";
                // line 43
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
                echo "
          </h1>
          ";
            }
            // line 46
            echo "
          ";
            // line 47
            if ( !twig_test_empty(twig_trim_filter($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["content"] ?? null), "field_category_program", []))))) {
                // line 48
                echo "          <h1 class=\"banner-title text-uppercase m-0 text-white\">
            ";
                // line 49
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_category_program", [])), "html", null, true);
                echo "
          </h1>
          ";
            }
            // line 52
            echo "
        </div>
      </div>
    </div>
  </div>
";
        }
        // line 58
        echo "
";
        // line 59
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalBreadcrumb(), "html", null, true);
        echo "
<div id=\"openy_alerts_header_placeholder\"></div>
";
        // line 61
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalBlock("local_tasks_block"), "html", null, true);
        echo "
<a id=\"main-content\" tabindex=\"-1\" class=\"sr-only sr-only-focusable\"></a>
";
    }

    public function getTemplateName()
    {
        return "@openy_carnation/node/include/header-default.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  146 => 61,  141 => 59,  138 => 58,  130 => 52,  124 => 49,  121 => 48,  119 => 47,  116 => 46,  110 => 43,  107 => 42,  105 => 41,  98 => 36,  90 => 32,  88 => 31,  84 => 29,  76 => 24,  71 => 22,  66 => 21,  64 => 20,  61 => 19,  59 => 16,  58 => 14,  55 => 12,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@openy_carnation/node/include/header-default.html.twig", "/var/www/docroot/profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/node/include/header-default.html.twig");
    }
}
