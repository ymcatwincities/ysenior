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

/* themes/custom/twelve_carnation/templates/page/page.html.twig */
class __TwigTemplate_cbc0dfb7687e6914d3aca079346ec116faf104be7607c79c42025f04d1d976a8 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'mobile_logo' => [$this, 'block_mobile_logo'],
            'fullsite_logo' => [$this, 'block_fullsite_logo'],
            'pagecontent' => [$this, 'block_pagecontent'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["block" => 55, "if" => 81];
        $filters = ["escape" => 48, "t" => 85, "trim" => 181, "render" => 181];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['block', 'if'],
                ['escape', 't', 'trim', 'render'],
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
        // line 48
        echo "<div class=\"layout-container ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["camp_class"] ?? null)), "html", null, true);
        echo "\">
  ";
        // line 50
        echo "  <div class=\"mobile-menu top-navs fixed-top d-block d-lg-none\">
    <nav class=\"nav-global navbar-default navbar navbar-dark\">
      <div class=\"container-fluid p-0\">
        <div class=\"d-flex w-100\">
          <div class=\"col-auto mr-auto\">
            ";
        // line 55
        $this->displayBlock('mobile_logo', $context, $blocks);
        // line 64
        echo "          </div>

          <div class=\"col-auto\">
            <button class=\"navbar-toggler border-0\" type=\"button\" data-toggle=\"collapse\" data-target=\".sidebar-left\" aria-controls=\"sidebar-left\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
              <span class=\"navbar-toggler-icon\"></span>
            </button>
          </div>

        </div>
      </div>
    </nav>
  </div>

  ";
        // line 78
        echo "  <div id=\"sidebar\" class=\"mobile-sidebar sidebar sidebar-left fixed-top collapse fade d-block d-lg-none\">
    <div class=\"row px-3 px-lg-0\">

        ";
        // line 81
        if (($context["display_search"] ?? null)) {
            // line 82
            echo "          <div class=\"search-form-wrapper col-12 border-top border-bottom\">
            <form method=\"get\" action=\"";
            // line 83
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["search_results_path"] ?? null)), "html", null, true);
            echo "\">
              <i class=\"fa fa-search search-input-decoration\" aria-hidden=\"true\"></i>
              <input type=\"search\" name=\"";
            // line 85
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["search_key"] ?? null)), "html", null, true);
            echo "\" class=\"search-input\" placeholder=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Search"));
            echo "\">
              <input type=\"submit\" type=\"submit\" value=\"Search\">
            </form>
          </div>
        ";
        }
        // line 90
        echo "
      <div class=\"page-head__main-menu col-12\">
        ";
        // line 92
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "top_menu", [])), "html", null, true);
        echo "
        ";
        // line 93
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "mobile_menu", [])), "html", null, true);
        echo "
      </div>

    </div>
  </div>

  <div class=\"viewport\">
    <header id=\"page-head\" class=\"page-head\">
      <div class=\"desktop-menu top-navs fixed-top d-none d-lg-block\" data-spy=\"affix\" data-offset-top=\"1\">
        <nav class=\"nav-global navbar-ymcags navbar p-0\">
          <div class=\"container-fluid m-0 p-0\">

            ";
        // line 106
        echo "            <div class=\"page-head__top-menu d-flex align-items-stretch w-100\">
              <div class=\"col-md-3 site-name\">
                  <span class=\"d-none d-lg-block\">
                    ";
        // line 109
        if (($context["site_slogan"] ?? null)) {
            // line 110
            echo "                      ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["site_slogan"] ?? null)), "html", null, true);
            echo "
                    ";
        }
        // line 112
        echo "                  </span>
              </div>
              <div class=\"col-md\">
                ";
        // line 115
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "secondary_menu", [])), "html", null, true);
        echo "
              </div>
            </div>
            <div class=\"col-md-12 header-content d-none d-sm-block p-0\">

                ";
        // line 121
        echo "                ";
        if (($context["display_search"] ?? null)) {
            // line 122
            echo "                  <div class=\"page-head__search fade collapse\">
                    <div class=\"search-form-wrapper\">
                      <form method=\"get\" action=\"";
            // line 124
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["search_results_path"] ?? null)), "html", null, true);
            echo "\">
                        <i class=\"fa fa-search search-input-decoration\" aria-hidden=\"true\"></i>
                        <input type=\"search\" name=\"";
            // line 126
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["search_key"] ?? null)), "html", null, true);
            echo "\" class=\"search-input\" placeholder=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Search"));
            echo "\">
                        <input type=\"submit\" value=\"Search\">
                      </form>
                      <button class=\"navbar-toggler page-head__search-close text-white\" type=\"button\" data-toggle=\"collapse\" data-target=\".page-head__search\" aria-controls=\"page-head__search\" aria-expanded=\"false\" aria-label=\"Hide search bar\">
                        <i class=\"fa fa-times\" aria-hidden=\"true\"></i>
                      </button>
                    </div>
                  </div>
                ";
        }
        // line 135
        echo "
                ";
        // line 137
        echo "                ";
        $this->displayBlock('fullsite_logo', $context, $blocks);
        // line 150
        echo "
                ";
        // line 152
        echo "                <div class=\"page-head__main-menu nav-home nav-desktop col-md-10\">
                  ";
        // line 153
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "primary_menu", [])), "html", null, true);
        echo "
                </div>
            </div>

          </div>
        </nav>
      </div>
    </header>

    ";
        // line 162
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "highlighted", [])), "html", null, true);
        echo "
    ";
        // line 163
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "help", [])), "html", null, true);
        echo "

    <main role=\"main\" class=\"clearfix mb-5\">

        ";
        // line 167
        $this->displayBlock('pagecontent', $context, $blocks);
        // line 170
        echo "    </main>

    <div class=\"pre-footer\">
      <div id=\"openy_alerts_header_placeholder\"></div>
      ";
        // line 174
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "pre_footer", [])), "html", null, true);
        echo "
    </div>

    <footer class=\"footer\">
      <div class=\"container py-5\">
        <div class=\"row py-3\">

          ";
        // line 181
        if ( !twig_test_empty(twig_trim_filter($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["page"] ?? null), "footer_info", []))))) {
            // line 182
            echo "          <div class=\"col-12 col-lg\">
            ";
            // line 183
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_info", [])), "html", null, true);
            echo "
          </div>
          ";
        }
        // line 186
        echo "
          ";
        // line 187
        if ( !twig_test_empty(twig_trim_filter($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["page"] ?? null), "footer_tel", []))))) {
            // line 188
            echo "          <div class=\"col-12 col-lg\">
              ";
            // line 189
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_tel", [])), "html", null, true);
            echo "
          </div>
          ";
        }
        // line 192
        echo "
          ";
        // line 193
        if ( !twig_test_empty(twig_trim_filter($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["page"] ?? null), "footer_mail", []))))) {
            // line 194
            echo "          <div class=\"col-12 col-lg\">
              ";
            // line 195
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_mail", [])), "html", null, true);
            echo "
          </div>
          ";
        }
        // line 198
        echo "
          ";
        // line 199
        if ( !twig_test_empty(twig_trim_filter($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["page"] ?? null), "footer_social", []))))) {
            // line 200
            echo "          <div class=\"col-12 col-lg text-center\">
            ";
            // line 201
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_social", [])), "html", null, true);
            echo "
          </div>
          ";
        }
        // line 204
        echo "
        </div>
      </div>

      <div class=\"footer__copyright container-fluid py-3\">
        <div class=\"row\">
          <div class=\"col-12 col-lg-8 order-1 order-lg-2 footer-menu-links\">
           ";
        // line 211
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_menus", [])), "html", null, true);
        echo "
          </div>
          <div class=\"col-12 col-lg-4 order-2 order-lg-1 footer-copy-links\">
           ";
        // line 214
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_copyright", [])), "html", null, true);
        echo "
          </div>
         </div>
       </div>
    </footer>

  </div>

</div>
";
    }

    // line 55
    public function block_mobile_logo($context, array $blocks = [])
    {
        // line 56
        echo "              ";
        if (($context["mobile_logo_url"] ?? null)) {
            // line 57
            echo "                <a class=\"mobile-logo d-block d-lg-none\" href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["front_page"] ?? null)), "html", null, true);
            echo "\" title=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t($this->sandbox->ensureToStringAllowed(($context["site_slogan"] ?? null))));
            echo "\" rel=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t($this->sandbox->ensureToStringAllowed(($context["site_slogan"] ?? null))));
            echo "\">
                  <img src=\"";
            // line 58
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["mobile_logo_url"] ?? null)), "html", null, true);
            echo "\" alt=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t($this->sandbox->ensureToStringAllowed(($context["site_slogan"] ?? null))));
            echo "\">
                </a>
              ";
        } else {
            // line 61
            echo "                <a class=\"navbar-brand\" href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)), "html", null, true);
            echo "\" title=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t($this->sandbox->ensureToStringAllowed(($context["site_slogan"] ?? null))));
            echo "\" rel=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t($this->sandbox->ensureToStringAllowed(($context["site_slogan"] ?? null))));
            echo "\"></a>
              ";
        }
        // line 63
        echo "            ";
    }

    // line 137
    public function block_fullsite_logo($context, array $blocks = [])
    {
        // line 138
        echo "                  <div class=\"col-md-2 logo\">
                    <span></span>
                    ";
        // line 140
        if (($context["logo_url"] ?? null)) {
            // line 141
            echo "                      <a class=\"d-block\" href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["front_page"] ?? null)), "html", null, true);
            echo "\" title=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t($this->sandbox->ensureToStringAllowed(($context["site_slogan"] ?? null))));
            echo "\" rel=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t($this->sandbox->ensureToStringAllowed(($context["site_slogan"] ?? null))));
            echo "\">
                        <img src=\"";
            // line 142
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["logo_url"] ?? null)), "html", null, true);
            echo "\" alt=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t($this->sandbox->ensureToStringAllowed(($context["site_slogan"] ?? null))));
            echo "\" />
                        <img src=\"";
            // line 143
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["transparent_logo_url"] ?? null)), "html", null, true);
            echo "\" alt=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t($this->sandbox->ensureToStringAllowed(($context["site_slogan"] ?? null))));
            echo "\" />
                      </a>
                    ";
        } else {
            // line 146
            echo "                      <a class=\"navbar-brand\" href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)), "html", null, true);
            echo "\" title=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t($this->sandbox->ensureToStringAllowed(($context["site_slogan"] ?? null))));
            echo "\" rel=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t($this->sandbox->ensureToStringAllowed(($context["site_slogan"] ?? null))));
            echo "\"></a>
                    ";
        }
        // line 148
        echo "                  </div>
                ";
    }

    // line 167
    public function block_pagecontent($context, array $blocks = [])
    {
        // line 168
        echo "          ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
        echo "
        ";
    }

    public function getTemplateName()
    {
        return "themes/custom/twelve_carnation/templates/page/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  409 => 168,  406 => 167,  401 => 148,  391 => 146,  383 => 143,  377 => 142,  368 => 141,  366 => 140,  362 => 138,  359 => 137,  355 => 63,  345 => 61,  337 => 58,  328 => 57,  325 => 56,  322 => 55,  308 => 214,  302 => 211,  293 => 204,  287 => 201,  284 => 200,  282 => 199,  279 => 198,  273 => 195,  270 => 194,  268 => 193,  265 => 192,  259 => 189,  256 => 188,  254 => 187,  251 => 186,  245 => 183,  242 => 182,  240 => 181,  230 => 174,  224 => 170,  222 => 167,  215 => 163,  211 => 162,  199 => 153,  196 => 152,  193 => 150,  190 => 137,  187 => 135,  173 => 126,  168 => 124,  164 => 122,  161 => 121,  153 => 115,  148 => 112,  142 => 110,  140 => 109,  135 => 106,  120 => 93,  116 => 92,  112 => 90,  102 => 85,  97 => 83,  94 => 82,  92 => 81,  87 => 78,  72 => 64,  70 => 55,  63 => 50,  58 => 48,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/twelve_carnation/templates/page/page.html.twig", "/var/www/docroot/themes/custom/twelve_carnation/templates/page/page.html.twig");
    }
}
