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

/* profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/field/field--paragraph--field-prgf-link--banner.html.twig */
class __TwigTemplate_2a4cd72f65ad97f4157b7c99b2da11e43923a5195381306ae70af2826ac994e3 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 41, "for" => 44];
        $filters = ["escape" => 43, "clean_class" => 43];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for'],
                ['escape', 'clean_class'],
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
        // line 41
        if (($context["label_hidden"] ?? null)) {
            // line 42
            echo "  ";
            if (($context["multiple"] ?? null)) {
                // line 43
                echo "    <div";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ("wrapper-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["field_name"] ?? null))))], "method")), "html", null, true);
                echo ">
      ";
                // line 44
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 45
                    echo "        <a href=\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["item"], "content", []), "#url", [], "array")), "html", null, true);
                    echo "\" class=\"btn btn-lg btn-outline-light\">
          ";
                    // line 46
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["item"], "content", []), "#title", [], "array")), "html", null, true);
                    echo "
        </a>
      ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 49
                echo "    </div>
  ";
            } else {
                // line 51
                echo "    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 52
                    echo "      <a href=\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["item"], "content", []), "#url", [], "array")), "html", null, true);
                    echo "\" class=\"btn btn-lg btn-outline-light\">
        ";
                    // line 53
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["item"], "content", []), "#title", [], "array")), "html", null, true);
                    echo "
      </a>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 56
                echo "  ";
            }
        } else {
            // line 58
            echo "  <div";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ("wrapper-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["field_name"] ?? null))))], "method")), "html", null, true);
            echo ">
    <div";
            // line 59
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["title_attributes"] ?? null), "addClass", [0 => ("label-for-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["field_name"] ?? null))))], "method")), "html", null, true);
            echo ">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
            echo "</div>
    ";
            // line 60
            if (($context["multiple"] ?? null)) {
                // line 61
                echo "    <div>
      ";
            }
            // line 63
            echo "      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 64
                echo "        <a href=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["item"], "content", []), "#url", [], "array")), "html", null, true);
                echo "\" class=\"btn btn-lg btn-outline-light\">
          ";
                // line 65
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["item"], "content", []), "#title", [], "array")), "html", null, true);
                echo "
        </a>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 68
            echo "      ";
            if (($context["multiple"] ?? null)) {
                // line 69
                echo "    </div>
    ";
            }
            // line 71
            echo "  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/field/field--paragraph--field-prgf-link--banner.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  153 => 71,  149 => 69,  146 => 68,  137 => 65,  132 => 64,  127 => 63,  123 => 61,  121 => 60,  115 => 59,  110 => 58,  106 => 56,  97 => 53,  92 => 52,  87 => 51,  83 => 49,  74 => 46,  69 => 45,  65 => 44,  60 => 43,  57 => 42,  55 => 41,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/field/field--paragraph--field-prgf-link--banner.html.twig", "/var/www/docroot/profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/field/field--paragraph--field-prgf-link--banner.html.twig");
    }
}
