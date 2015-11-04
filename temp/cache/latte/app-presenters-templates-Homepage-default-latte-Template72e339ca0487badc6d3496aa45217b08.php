<?php
// source: C:\Users\prcharom\Desktop\EasyPHP-DevServer-14.1VC9\data\localweb\e_nastenka\app\presenters/templates/Homepage/default.latte

class Template72e339ca0487badc6d3496aa45217b08 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('56f11cabaf', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb9d4e31029b_content')) { function _lb9d4e31029b_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div id="banner">
	<h1>
		<img src="images/logo.png">
<?php call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars())  ?>
	</h1>
</div>

<div id="content">
	<h2>Výpis zvířat v naší zoo:</h2>
	<ul>
<?php $iterations = 0; foreach ($zviratka as $zviratko) { ?>
			<li><?php echo Latte\Runtime\Filters::escapeHtml($zviratko, ENT_NOQUOTES) ?></li>
<?php $iterations++; } ?>
	</ul>
</div>
<?php
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb9972f7f2b2_title')) { function _lb9972f7f2b2_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>		<span>e-nástěnka..</span>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb6e81d767a8_head')) { function _lb6e81d767a8_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
	html { overflow-y: scroll; }
	body { font: 12px/1.45 Verdana, "Geneva CE", lucida, sans-serif; background: #3484d2; color: #555; margin: 38px auto; max-width: 940px; min-width: 420px; }

	h1, h2 { font: normal 150%/1.3 Georgia, "New York CE", utopia, serif; color: #1e5eb6; -webkit-text-stroke: 1px rgba(0,0,0,0); }
	h1 img { float: left; margin: -0.6em 1em 0 0; height: 46px;}
	img { border: none; }

	a { color: #006aeb; padding: 3px 1px; }

	a:hover, a:active, a:focus { background-color: #006aeb; text-decoration: none; color: white; }
	
	#banner { background: yellow; color: darkblue; padding: 1em; border: 1px solid #eff4f7;
    border-radius: 12px 12px 0 0;}

	#content { background: white; border: 1px solid #eff4f7; border-radius: 0 0 12px 12px; padding: 10px 4%; overflow: hidden; }
	#content > h2 { font-size: 130%; color: #666; clear: both; padding: 1.2em 0; margin: 0; }

	h2 span { color: #87A7D5; }
	h2 a { text-decoration: none; background: transparent; }
	ul { margin: 0 0 1em 0;}

</style>
<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>


<?php call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars()) ; 
}}