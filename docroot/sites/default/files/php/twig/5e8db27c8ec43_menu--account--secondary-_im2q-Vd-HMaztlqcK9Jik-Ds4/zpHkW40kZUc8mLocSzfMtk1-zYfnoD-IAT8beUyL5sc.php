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

/* themes/custom/twelve_carnation/templates/menu/menu--account--secondary-menu.html.twig */
class __TwigTemplate_a110c0f9c9e49d208f2bd2c5dff0ab9aa2cc67c59ec4f76d2337b067462c90c5 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["import" => 23, "if" => 29, "macro" => 42, "set" => 45, "for" => 47];
        $filters = ["escape" => 46];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['import', 'if', 'macro', 'set', 'for'],
                ['escape'],
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
        // line 23
        $context["menus"] = $this;
        // line 24
        echo "
";
        // line 29
        if (($context["logged_in"] ?? null)) {
            // line 30
            echo "  ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["menus"]->getmenu_links(($context["items"] ?? null), ($context["attributes"] ?? null), 0));
            echo "
";
        } else {
            // line 32
            echo "  <ul region=\"secondary_menu\" class=\"navbar-nav flex-row float-right\">
    <li class=\"h-100 d-flex align-items-center\">
      <i class=\"soon-icon fa fa-user\"></i>
      <a href=\"#\" class=\"nav-link px-4 coming-soon\">
        SIGN IN [COMING SOON]
      </a>
    </li>
  </ul>
";
        }
        // line 41
        echo "
";
    }

    // line 42
    public function getmenu_links($__items__ = null, $__attributes__ = null, $__menu_level__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "items" => $__items__,
            "attributes" => $__attributes__,
            "menu_level" => $__menu_level__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 43
            echo "  ";
            $context["menus"] = $this;
            // line 44
            echo "  ";
            if (($context["items"] ?? null)) {
                // line 45
                echo "    ";
                $context["attributes"] = $this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => [0 => "navbar-nav flex-row float-right"]], "method");
                // line 46
                echo "    <ul";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null)), "html", null, true);
                echo ">
    ";
                // line 47
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 48
                    echo "      ";
                    // line 49
                    $context["classes"] = [0 => (($this->getAttribute(                    // line 50
$context["item"], "in_active_trail", [])) ? ("is-active") : ("")), 1 => (($this->getAttribute(                    // line 51
$context["item"], "below", [])) ? ("dropdown") : ("")), 2 => "h-100 d-flex align-items-center"];
                    // line 55
                    echo "      <li";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["item"], "attributes", []), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
                    echo ">
        ";
                    // line 56
                    if ($this->getAttribute($context["item"], "below", [])) {
                        // line 57
                        echo "          <a data-toggle=\"dropdown\" href=\"";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "url", [])), "html", null, true);
                        echo "\" class=\"nav-link px-4\">
            ";
                        // line 58
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "title", [])), "html", null, true);
                        echo "
            <i class=\"fa fa-angle-up\" aria-hidden=\"true\"></i>
            <i class=\"fa fa-angle-down\" aria-hidden=\"true\"></i>
          </a>
        ";
                    } else {
                        // line 63
                        echo "          <a href=\"";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "url", [])), "html", null, true);
                        echo "\" class=\"nav-link px-4\">
            ";
                        // line 64
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "title", [])), "html", null, true);
                        echo "
          </a>
        ";
                    }
                    // line 67
                    echo "      </li>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 69
                echo "    </ul>
  ";
            }
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "themes/custom/twelve_carnation/templates/menu/menu--account--secondary-menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  160 => 69,  153 => 67,  147 => 64,  142 => 63,  134 => 58,  129 => 57,  127 => 56,  122 => 55,  120 => 51,  119 => 50,  118 => 49,  116 => 48,  112 => 47,  107 => 46,  104 => 45,  101 => 44,  98 => 43,  84 => 42,  79 => 41,  68 => 32,  62 => 30,  60 => 29,  57 => 24,  55 => 23,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/twelve_carnation/templates/menu/menu--account--secondary-menu.html.twig", "/var/www/docroot/themes/custom/twelve_carnation/templates/menu/menu--account--secondary-menu.html.twig");
    }
}
