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

/* profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/menu/menu--main--primary-menu.html.twig */
class __TwigTemplate_97dfdedbbd4dc02d3e7b317360358c1ec59333fe6037e06024e10bb11031b962 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["import" => 23, "macro" => 31, "if" => 33, "for" => 35, "set" => 36];
        $filters = ["escape" => 34, "clean_class" => 38];
        $functions = ["link" => 79];

        try {
            $this->sandbox->checkSecurity(
                ['import', 'macro', 'if', 'for', 'set'],
                ['escape', 'clean_class'],
                ['link']
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
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["menus"]->getmenu_links(($context["items"] ?? null), ($context["attributes"] ?? null), 0, ($context["display_search"] ?? null)));
        echo "

";
        // line 64
        echo "
";
        // line 86
        echo "
";
    }

    // line 31
    public function getmenu_links($__items__ = null, $__attributes__ = null, $__menu_level__ = null, $__display_search__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "items" => $__items__,
            "attributes" => $__attributes__,
            "menu_level" => $__menu_level__,
            "display_search" => $__display_search__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 32
            echo "  ";
            $context["menus"] = $this;
            // line 33
            echo "  ";
            if (($context["items"] ?? null)) {
                // line 34
                echo "    <ul";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => "navbar nav nav-fill align-items-center nav-level-1 p-0 m-0"], "method")), "html", null, true);
                echo ">
    ";
                // line 35
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 36
                    echo "      ";
                    $context["ia"] = $this->getAttribute($context["item"], "attributes", []);
                    // line 37
                    echo "      ";
                    $context["ia"] = $this->getAttribute(($context["ia"] ?? null), "addClass", [0 => "nav-item nav-level-2"], "method");
                    // line 38
                    echo "      <li";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["item"], "attributes", []), "addClass", [0 => ("menu-item-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "title", []))))], "method")), "html", null, true);
                    echo ">
        ";
                    // line 39
                    if ($this->getAttribute($context["item"], "below", [])) {
                        // line 40
                        echo "          <a data-toggle=\"dropdown\" href=\"";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "url", [])), "html", null, true);
                        echo "\" class=\"nav-link text-uppercase\" aria-expanded=\"false\">
            ";
                        // line 41
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "title", [])), "html", null, true);
                        echo "
            <i class=\"fa fa-angle-up\" aria-hidden=\"true\"></i>
            <i class=\"fa fa-angle-down\" aria-hidden=\"true\"></i>
          </a>
          ";
                        // line 45
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["menus"]->getmenu_links_level_2($this->getAttribute($context["item"], "below", []), ($context["attributes"] ?? null), (($context["menu_level"] ?? null) + 1)));
                        echo "
        ";
                    } else {
                        // line 47
                        echo "          <a href=\"";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "url", [])), "html", null, true);
                        echo "\" class=\"nav-link text-uppercase\">
            ";
                        // line 48
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "title", [])), "html", null, true);
                        echo "
          </a>
        ";
                    }
                    // line 51
                    echo "      </li>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 53
                echo "    ";
                if (($context["display_search"] ?? null)) {
                    // line 54
                    echo "      ";
                    // line 55
                    echo "      <li class=\"nav-item nav-level-2 site-search\">
        <button class=\"navbar-toggler pr-3\" type=\"button\" data-toggle=\"collapse\" data-target=\".page-head__search\" aria-controls=\"page-head__search\" aria-expanded=\"false\" aria-label=\"Show search bar\">
          <i class=\"fa fa-search\" aria-hidden=\"true\"></i>
        </button>
      </li>
    ";
                }
                // line 61
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

    // line 65
    public function getmenu_links_level_2($__items__ = null, $__attributes__ = null, $__menu_level__ = null, ...$__varargs__)
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
            // line 66
            echo "  ";
            $context["menus"] = $this;
            // line 67
            echo "  ";
            if (($context["items"] ?? null)) {
                // line 68
                echo "    <ul class=\"dropdown-menu row-level-2 fade\">
    ";
                // line 69
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 70
                    echo "      ";
                    $context["ia"] = $this->getAttribute($this->getAttribute($context["item"], "attributes", []), "addClass", [0 => [0 => ("nav-level-3 col-md-3 col-lg-2 menu-item-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "title", []))))]], "method");
                    // line 71
                    echo "      <li";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["ia"] ?? null)), "html", null, true);
                    echo ">
        ";
                    // line 72
                    if ($this->getAttribute($context["item"], "below", [])) {
                        // line 73
                        echo "          <a href=\"";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "url", [])), "html", null, true);
                        echo "\" class=\"d-flex\">
            <i class=\"fa fa-angle-right pr-2\" aria-hidden=\"true\"></i>
            ";
                        // line 75
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "title", [])), "html", null, true);
                        echo "
          </a>
          ";
                        // line 77
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["menus"]->getmenu_links_level_3($this->getAttribute($context["item"], "below", []), $context["item"], ($context["attributes"] ?? null), ($context["menu_level"] ?? null)));
                        echo "
        ";
                    } else {
                        // line 79
                        echo "          ";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getLink($this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "title", [])), $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "url", []))), "html", null, true);
                        echo "
        ";
                    }
                    // line 81
                    echo "      </li>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 83
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

    // line 87
    public function getmenu_links_level_3($__items__ = null, $__parent__ = null, $__attributes__ = null, $__menu_level__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "items" => $__items__,
            "parent" => $__parent__,
            "attributes" => $__attributes__,
            "menu_level" => $__menu_level__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 88
            echo "  ";
            $context["menus"] = $this;
            // line 89
            echo "  ";
            if (($context["items"] ?? null)) {
                // line 90
                echo "    <ul class=\"row-level-3\">
      ";
                // line 91
                $context["ia"] = $this->getAttribute(($context["parent"] ?? null), "attributes", []);
                // line 92
                echo "      ";
                $context["ia"] = $this->getAttribute(($context["ia"] ?? null), "addClass", [0 => "nav-level-4"], "method");
                // line 93
                echo "      ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 94
                    echo "        ";
                    $context["ia"] = $this->getAttribute($context["item"], "attributes", []);
                    // line 95
                    echo "        ";
                    $context["ia"] = $this->getAttribute(($context["ia"] ?? null), "addClass", [0 => "nav-level-4"], "method");
                    // line 96
                    echo "        <li";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["ia"] ?? null)), "html", null, true);
                    echo ">
          ";
                    // line 97
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getLink($this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "title", [])), $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "url", []))), "html", null, true);
                    echo "
        </li>
      ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 100
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
        return "profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/menu/menu--main--primary-menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  318 => 100,  309 => 97,  304 => 96,  301 => 95,  298 => 94,  293 => 93,  290 => 92,  288 => 91,  285 => 90,  282 => 89,  279 => 88,  264 => 87,  247 => 83,  240 => 81,  234 => 79,  229 => 77,  224 => 75,  218 => 73,  216 => 72,  211 => 71,  208 => 70,  204 => 69,  201 => 68,  198 => 67,  195 => 66,  181 => 65,  164 => 61,  156 => 55,  154 => 54,  151 => 53,  144 => 51,  138 => 48,  133 => 47,  128 => 45,  121 => 41,  116 => 40,  114 => 39,  109 => 38,  106 => 37,  103 => 36,  99 => 35,  94 => 34,  91 => 33,  88 => 32,  73 => 31,  68 => 86,  65 => 64,  60 => 29,  57 => 24,  55 => 23,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/menu/menu--main--primary-menu.html.twig", "/var/www/docroot/profiles/contrib/openy/themes/openy_themes/openy_carnation/templates/menu/menu--main--primary-menu.html.twig");
    }
}
