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

/* profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/paragraph/paragraph--grid-content--default.html.twig */
class __TwigTemplate_9eeb16b7abffe092603d92cd7438138ba3802f89ef043262533861febd889c7c extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 40, "if" => 52, "for" => 60];
        $filters = ["clean_class" => 45, "escape" => 59];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'for'],
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
        $context["classes"] = [0 => "row", 1 => "justify-content-center", 2 => "paragraph", 3 => "paragraph--column-in-a-grid", 4 => ("paragraph--type--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute(        // line 45
($context["paragraph"] ?? null), "bundle", [])))), 5 => ((        // line 46
($context["view_mode"] ?? null)) ? (("paragraph--view-mode--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["view_mode"] ?? null))))) : (""))];
        // line 49
        $context["grid_style"] = $this->getAttribute($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_prgf_grid_style", []), 0, [], "array"), "#markup", [], "array");
        // line 50
        $context["item_class"] = "col-12 col-lg";
        // line 51
        echo "
";
        // line 52
        if ((($context["grid_style"] ?? null) == "2")) {
            // line 53
            echo "  ";
            $context["item_class"] = "col-lg-6";
        } elseif ((        // line 54
($context["grid_style"] ?? null) == "3")) {
            // line 55
            echo "  ";
            $context["item_class"] = "col-lg-4";
        } elseif ((        // line 56
($context["grid_style"] ?? null) == "4")) {
            // line 57
            echo "  ";
            $context["item_class"] = "col-lg-3";
        }
        // line 59
        echo "<div";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
        echo ">
  ";
        // line 60
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["content"] ?? null), "field_grid_columns", []));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 61
            echo "    ";
            if (preg_match("/^\\d+\$/", $context["key"])) {
                // line 62
                echo "    <div class=\"col-12 ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["item_class"] ?? null)), "html", null, true);
                echo " row-eq-height\">
      ";
                // line 63
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["item"]), "html", null, true);
                echo "
    </div>
    ";
            }
            // line 66
            echo "  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/paragraph/paragraph--grid-content--default.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  111 => 67,  105 => 66,  99 => 63,  94 => 62,  91 => 61,  87 => 60,  82 => 59,  78 => 57,  76 => 56,  73 => 55,  71 => 54,  68 => 53,  66 => 52,  63 => 51,  61 => 50,  59 => 49,  57 => 46,  56 => 45,  55 => 40,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/paragraph/paragraph--grid-content--default.html.twig", "/var/www/docroot/profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/paragraph/paragraph--grid-content--default.html.twig");
    }
}
