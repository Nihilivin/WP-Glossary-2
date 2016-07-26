<?php

use \ithoughts\tooltip_glossary\Backbone as Backbone;
/**
 * @file Template file for TinyMCE "Insert a tooltip" editor
 *
 * @author Gerkin
 * @copyright 2016 GerkinDevelopment
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.fr.html GPLv2
 * @package ithoughts-tooltip-glossary
 *
 * @version 2.5.0
 */



if ( ! defined( 'ABSPATH' ) ) { 
	exit; // Exit if accessed directly
}

?>
<div id="ithoughts_tt_gl-tooltip-form-container">
	<!--<pre style="display:none;"><?php var_dump($data); ?></pre>-->
	<div id="pseudohead">
		<link rel="stylesheet" id="ithoughts_tt_gl-tinymce_form-css" href="<?php echo Backbone::get_instance()->get_base_url(); ?>/css/ithoughts_tt_gl-tinymce-forms.css" type="text/css" media="all">
		<script type="text/javascript" src="<?php echo Backbone::get_instance()->get_base_url(); ?>/submodules/iThoughts-WordPress-Plugin-Toolbox/js/simple-ajax-form-v3.js" defer></script>
		<script>
			ithoughts_tt_gl.tinymce = <?php echo json_encode($form_data); ?>;
		</script>
		<script type="text/javascript" src="<?php echo Backbone::get_instance()->get_base_url(); ?>/js/ithoughts_tt_gl-tinymce-forms.js" defer></script>
	</div>
	<div aria-label="<?php _e("Insert a Tooltip", 'ithoughts-tooltip-glossary' ); ?>" role="dialog" style="border-width: 1px; z-index: 999999;" class="mce-container mce-panel mce-floatpanel mce-window mce-in" hidefocus="1" id="ithoughts_tt_gl-tooltip-form">
		<div class="mce-reset" role="application">
			<div class="mce-window-head">
				<div class="mce-title">
					<?php _e("Insert a Tooltip", 'ithoughts-tooltip-glossary' ); ?>
				</div>
				<button aria-hidden="true" class="mce-close ithoughts_tt_gl-tinymce-discard" type="button">×</button>
			</div>


			<div class="mce-container-body mce-window-body">
				<div class="mce-container mce-form mce-first mce-last">
					<div class="mce-container-body" style="height: 100%;">







						<form>
							<div style="padding:10px;flex:0 0 auto;">
								<table>
									<tr>
										<td>
											<label for="itghouts_tt_gl_text">
												<?php _e("Text", 'ithoughts-tooltip-glossary' ); ?>
											</label>
										</td>
										<td>
											<input type="text" autocomplete="off" id="ithoughts_tt_gl_text" name="ithoughts_tt_gl_text" value="<?php echo $data["text"]; ?>">
										</td>
									</tr>
									<tr>
										<td>
											<label for="itghouts_tt_gl_link">
												<?php _e("Link", 'ithoughts-tooltip-glossary' ); ?>
											</label>
										</td>
										<td>
											<input type="text" autocomplete="off" id="ithoughts_tt_gl_link" name="ithoughts_tt_gl_link" value="<?php echo $data["link"]; ?>" data-warning-title="<?php _e("Warning!", "ithoughts-tooltip-glossary"); ?>" data-warning-text="<p><?php echo nl2br(__("Changing this property on a glossary tip may confuse your users.
                                            You were warned...", "ithoughts-tooltip-glossary")); ?></p>"/>
										</td>
									</tr>
								</table>
							</div>

							<div class="tab-container">
								<ul id="ithoughts_tt_gl-tabs-mode" class="tabs" role="tablist" data-init-tab-index="<?php echo array_search($data['type'], array("glossary", "tooltip", "mediatip")); ?>">
									<li role="tab" tabindex="-1">
										<?php _e("Glossary term", 'ithoughts-tooltip-glossary' ); ?>
									</li>


									<li role="tab" tabindex="-1">
										<?php _e("Tooltip", 'ithoughts-tooltip-glossary' ); ?>
									</li>


									<li role="tab" tabindex="-1">
										<?php _e("Mediatip", 'ithoughts-tooltip-glossary' ); ?>
									</li>
								</ul>



								<div class="tab">
									<table>
										<?php
										if ( function_exists('icl_object_id') ) {
										?>
										<tr>
											<td colspan="2">
												<b><?php _e("Note:", 'ithoughts-tooltip-glossary' ); ?></b><br/>
												<?php _e("During search, terms appearing with a <span class=\"foreign-language\">yellow background</span> are not available in current language.", 'ithoughts-tooltip-glossary' ); ?>
											</td>
										</tr>
										<?php
										}
										?>
										<tr>
											<td>
												<label for="glossary_term">
													<?php _e("Term", 'ithoughts-tooltip-glossary' ); ?>
												</label>
											</td>
											<td>
												<input autocomplete="off" type="text" id="glossary_term" name="glossary_term" value="<?php echo (isset($data["term_title"])) ? $data["term_title"] : $data["term_search"]; ?>" class="completed"/>
												<div id="glossary_term_completer_container" class="hidden">
													<div id="glossary_term_completer" class="completer">
													</div>
												</div>
												<input type="hidden" name="glossary_term_id" value="<?php echo $data["glossary_id"]; ?>">
											</td>
										</tr>
										<?php
										if ( function_exists('icl_object_id') ) {
										?>
										<tr>
											<td>
												<label for="glossary_disable_auto_translation">
													<?php _e("Disable<br/>auto-translation", 'ithoughts-tooltip-glossary' ); ?>
												</label>
											</td>
											<td>
												<input type="checkbox" id="glossary_disable_auto_translation" name="glossary_disable_auto_translation" value="true" <?php echo ((isset($data["glossary_disable_auto_translation"]) && $data["glossary_disable_auto_translation"]) ? " checked" : ""); ?>/>
											</td>
										</tr>
										<?php
										}
										?>
									</table>
								</div>



								<div class="tab">
									<table>
										<tr>
											<td colspan="2">
												<label class="mce-widget mce-label mce-first" for="ithoughts_tt_gl-tooltip-content">
													<?php _e("Content", 'ithoughts-tooltip-glossary' ); ?>
												</label>
												<div style="margin:0 -11px;">
													<textarea class="tinymce" id="ithoughts_tt_gl-tooltip-content"><?php echo htmlentities($data['tooltip_content']); ?></textarea>
												</div>
											</td>
										</tr>
									</table>
								</div>



								<div class="tab">
									<table>
										<tr>
											<td>
												<label for="mediatip_type">
													<?php _e("Mediatip type", 'ithoughts-tooltip-glossary' ); ?>
												</label>
											</td>
											<td>
												<?php echo $inputs['mediatip_type'] ?>
											</td>
										</tr>
										<tr data-mediatip_type="mediatip-localimage-type">
											<td colspan="2">
												<div class="mce-container " id="image-box">
													<?php
	if(isset($data["mediatip_content"]['url']) && $data["mediatip_content"]['url']):
													?>
													<img src="<?php echo $data["mediatip_content"]['url']; ?>"/>
													<?php
													endif;
													?>
												</div>
												<input id="image-box-data" style="display: none;" value="<?php echo $data["mediatip_content_json"]; ?>">
												<div class="mce-widget mce-btn mce-last mce-btn-has-text" role="button" style="width: 100%; height: 30px;" tabindex="-1">
													<button role="presentation" style="height: 100%; width: 100%;" tabindex="-1" type="button" id="ithoughts_tt_gl_select_image">
														<?php _e("Select an image", 'ithoughts-tooltip-glossary' ); ?>
													</button>
												</div>
											</td>
										</tr>
										<tr data-mediatip_type="mediatip-webimage-type">
											<td>
												<label for="mediatip_url_image">
													<?php _e("Image url", 'ithoughts-tooltip-glossary' ); ?>
												</label>
											</td>
											<td>
												<input autocomplete="off" type="url" name="mediatip_url_image" id="mediatip_url_image" value="<?php echo (($data["mediatip_type"] == "webimage") ? $data["mediatip_content_json"] : ""); ?>"/>
											</td>
										</tr>
										<tr data-mediatip_type="mediatip-webimage-type mediatip-localimage-type">
											<td>
												<label for="mediatip_caption">
													<?php _e("Caption", 'ithoughts-tooltip-glossary' ); ?>
												</label>
											</td>
											<td>
												<textarea autocomplete="off" name="mediatip_caption" id="mediatip_caption" style="width:100%;border:1px solid #ccc;"><?php echo (in_array($data["mediatip_type"], array("webimage", "localimage"))) ? $data["mediatip_caption"] : "" ?></textarea>
											</td>
										</tr>
										<tr data-mediatip_type="mediatip-webvideo-type">
											<td>
												<label for="mediatip_url_video">
													<?php _e("Video integration code", 'ithoughts-tooltip-glossary' ); ?>
												</label>
											</td>
											<td>
												<input autocomplete="off" type="text" name="mediatip_url_video_link" id="mediatip_url_video_link" value="<?php echo (($data["mediatip_type"] == "webvideo") ? $data["mediatip_link"] : ""); ?>"/>
												<input autocomplete="off" type="hidden" name="mediatip_url_video_embed" id="mediatip_url_video_embed" value="<?php echo (($data["mediatip_type"] == "webvideo") ? $data["mediatip_content"] : ""); ?>"/>
												<input autocomplete="off" type="hidden" name="mediatip_url_video_link" id="mediatip_url_video_link" value="<?php echo (($data["mediatip_type"] == "webvideo") ? $data["mediatip_link"] : ""); ?>"/>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</form>






					</div>
				</div>
			</div>


			<div class="mce-container mce-panel mce-foot"tabindex="-1">
				<div class="mce-container-body">
					<div class="mce-btn" role="button" tabindex="-1" style="float:left;">
						<button role="presentation" style="height: 100%; width: 100%;" tabindex="-1" type="button" id="ithoughts_tt_gl-tinymce-advanced_options">
							<?php _e("Advanced attributes", 'ithoughts-tooltip-glossary' ); ?>
						</button>
					</div>


					<div class="mce-btn mce-primary" role="button" tabindex="-1">
						<button role="presentation" style="height: 100%; width: 100%;" tabindex="-1" type="button" id="ithoughts_tt_gl-tinymce-validate">
							<?php _e("Ok", 'ithoughts-tooltip-glossary' ); ?>
						</button>
					</div>


					<div class="mce-btn" role="button" tabindex="-1">
						<button role="presentation" style="height: 100%; width: 100%;" tabindex="-1" type="button" class="ithoughts_tt_gl-tinymce-discard">
							<?php _e("Discard", 'ithoughts-tooltip-glossary' ); ?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div aria-label="<?php _e("Tooltip options", 'ithoughts-tooltip-glossary' ); ?>" role="dialog" style="border-width: 1px; z-index: 9999999; display:none" class="mce-container mce-panel mce-floatpanel mce-window mce-in" hidefocus="1" id="ithoughts_tt_gl-tooltip-form-options"> 
		<div class="mce-reset" role="application"> 
			<div class="mce-window-head"> 
				<div class="mce-title"> 
					<?php _e("Tooltip options", 'ithoughts-tooltip-glossary' ); ?> 
				</div> 
				<button aria-hidden="true" class="mce-close ithoughts_tt_gl-tinymce-discard" type="button">×</button> 
			</div> 
			<div class="mce-container-body mce-window-body"> 
				<div class="mce-container mce-form mce-first mce-last"> 
					<div class="mce-container-body" style="height: 100%;"> 
						<form> 
							<div style="flex:0 0 auto;"> 
								<div class="tab-container">
									<ul class="tabs" role="tablist">
										<li role="tab" tabindex="-1" class="active">
											<?php _e("Customize", 'ithoughts-tooltip-glossary' ); ?>
										</li>


										<li role="tab" tabindex="-1">
											<?php _e("Attributes", 'ithoughts-tooltip-glossary' ); ?>
										</li>
									</ul>

									<div class="tab active">
										<table> 
											<tr> 
												<td> 
													<label for="qtip-content"> 
														<?php _e("Tooltip content", 'ithoughts-tooltip-glossary' ); ?> 
													</label> 
												</td> 
												<td> 
													<?php echo $inputs["qtip-content"]; ?> 
												</td> 
											</tr>
											<tr> 
												<td> 
													<label for="qtip-keep-open"> 
														<?php echo apply_filters('ithoughts-tt-gl_tooltip', __("Delay tooltip hide", 'ithoughts-tooltip-glossary' ), __('Add a timer of 500ms before hiding the tooltip. This allow the user to click into the tip. This option is enabled by default for video mediatips.', 'ithoughts-tooltip-glossary' )); ?>
													</label> 
												</td> 
												<td> 
													<?php echo $inputs["qtip-keep-open"]; ?> 
												</td> 
											</tr>
											<tr> 
												<td> 
													<label for="qtiptrigger"> 
														<?php _e("Tooltip trigger", 'ithoughts-tooltip-glossary' ); ?>
													</label> 
												</td> 
												<td> 
													<?php echo $inputs["qtiptrigger"]; ?> 
													<?php echo $inputs['qtiptriggerText']; ?>
												</td> 
											</tr> 
											<tr> 
												<td> 
													<label for="qtipstyle"> 
														<?php _e("Tooltip style", 'ithoughts-tooltip-glossary' ); ?> 
													</label> 
												</td> 
												<td> 
													<?php echo $inputs["qtipstyle"]; ?> 
												</td> 
											</tr> 
											<tr> 
												<td> 
													<label for="qtipshadow"> 
														<?php _e("Tooltip shadow", 'ithoughts-tooltip-glossary' ); ?> 
													</label> 
												</td> 
												<td> 
													<?php echo $inputs["qtipshadow"]; ?> 
												</td> 
											</tr> 
											<tr> 
												<td> 
													<label for="qtiprounded"> 
														<?php _e("Rounded corners", 'ithoughts-tooltip-glossary' ); ?> 
													</label> 
												</td> 
												<td> 
													<?php echo $inputs["qtiprounded"]; ?> 
												</td> 
											</tr>
											<tr>
												<td>
													<label for="position_my">
														<?php echo apply_filters('ithoughts-tt-gl_tooltip', __("Position of the tip", 'ithoughts-tooltip-glossary' ), __('Position of the sharp tip around the tooltip. By default, the main axis is vertical', 'ithoughts-tooltip-glossary' )); ?>
													</label>
												</td>
												<td>
													<?php
													echo '<div style="display:inline;">'.$inputs["position"]["my"][1].'</div>';
													echo '<div style="display:inline;">'.$inputs["position"]["my"][2].'</div>';
													?>
													<label for="position_my_invert"><?php echo $inputs["position"]["my"]["invert"];_e("Invert main axis", 'ithoughts-tooltip-glossary' ); ?></label>
												</td>
											</tr>
											<tr>
												<td>
													<label for="position_at"> 
														<?php echo apply_filters('ithoughts-tt-gl_tooltip', __("Position of the tooltip", 'ithoughts-tooltip-glossary' ), __('Position of the tooltip around the target area', 'ithoughts-tooltip-glossary' )); ?>
													</label>
												</td>
												<td>
													<?php
													echo '<div style="display:inline;">'.$inputs["position"]["at"][1].'</div>';
													echo '<div style="display:inline;">'.$inputs["position"]["at"][2].'</div>';
													?>
												</td>
											</tr>
											<tr> 
												<td> 
													<label for="in_out"> 
														<?php _e("Animations", 'ithoughts-tooltip-glossary' ); ?> 
													</label> 
												</td> 
												<td> 
													<label for="anim[in]"><?php _e("In", 'ithoughts-tooltip-glossary' ); ?>:&nbsp;<?php echo $inputs["anim"]["in"]; ?></label>&nbsp;&nbsp;
													<label for="anim[out]"><?php _e("Out", 'ithoughts-tooltip-glossary' ); ?>:&nbsp;<?php echo $inputs["anim"]["out"]; ?></label>&nbsp;&nbsp;
													<label for="anim[time]"><?php _e("Duration", 'ithoughts-tooltip-glossary' ); ?>:&nbsp;<?php echo $inputs["anim"]["time"]; ?>ms</label>
												</td> 
											</tr>
											<tr> 
												<td> 
													<label for="maxwidth"> 
														<?php echo apply_filters('ithoughts-tt-gl_tooltip', __("Max width", 'ithoughts-tooltip-glossary' ), __('Maximum width of the tooltip. The default value of this property is 280px. Be carefull about this option: a too high value may overflow outside small devices.', 'ithoughts-tooltip-glossary' )); ?>
													</label> 
												</td> 
												<td> 
													<?php echo $inputs["maxwidth"]; ?> 
												</td> 
											</tr>
										</table> 
									</div>
									<div class="tab">
										<table>
											<tr> 
												<td colspan="2"> 
													<div> 
														<h3 style="text-align: center;"> 
															<b> 
																<?php _e("Attributes", 'ithoughts-tooltip-glossary' ); ?> 
															</b> 
														</h3> 
														<datalist id="attributes-list"> 
															<?php 
															foreach($attrs as $attr) 
																echo "<option value=\"$attr\"/>"; 
															?> 
														</datalist> 
													</div> 
													<div id="ithoughts_tt_gl-attrs-table"> 
														<div> 
															<h4 style="text-align: center;"> 
																<b> 
																	<?php _e("Span attribute", 'ithoughts-tooltip-glossary' ); ?> 
																</b> 
															</h4> 
															<hr/> 
															<div> 
																<div>
																	<div class="ithoughts-attrs-container" data-attr-family="span">
																		<?php $i = 0;
																		foreach($opts["attributes"]["span"] as $key => $value){ ?>
																		<div class="attribute-name-val <?php echo ($i == 0) ? 'ithoughts-prototype' : ''; ?>">
																			<div class="kv-pair"> 
																				<label for="attributes-span-key-<?php echo $i; ?>"class="dynamicId dynamicId-key"> 
																					<?php _e("Key", 'ithoughts-tooltip-glossary' ); ?> 
																				</label> 
																				<input type="text" <?php echo ($i == 0) ? 'disabled' : ''; ?> class="dynamicId dynamicId-key" value="<?php echo $key; ?>" autocomplete="off" list="attributes-list" name="attributes-span-key[]" id="attributes-span-key-<?php echo $i; ?>" /> 
																			</div> 
																			<div class="kv-pair"> 
																				<label for="attributes-span-value-<?php echo $i; ?>"class="dynamicId dynamicId-value"> 
																					<?php _e("Value", 'ithoughts-tooltip-glossary' ); ?> 
																				</label> 
																				<input type="text" <?php echo ($i == 0) ? 'disabled' : ''; ?> class="dynamicId dynamicId-value" value="<?php echo $value; ?>" autocomplete="off" name="attributes-span-value[]" id="attributes-span-value-<?php echo $i; ?>" /> 
																			</div>
																		</div>
																		<?php $i++;
																		} ?>
																	</div>
																	<div style="clear:both;"></div> 
																	<button type="button" id="kv-pair-span-attrs-add" class="button button-primary button-large"><?php _e("Add", 'ithoughts-tooltip-glossary' ); ?></button> 
																</div> 
															</div> 
														</div> 
														<div> 
															<h4 style="text-align: center;"> 
																<b> 
																	<?php _e("Link attribute", 'ithoughts-tooltip-glossary' ); ?> 
																</b> 
															</h4> 
															<hr/> 
															<div> 
																<div> 
																	<div class="ithoughts-attrs-container" data-attr-family="link">
																		<?php $i = 0;
																		foreach($opts["attributes"]["link"] as $key => $value){ ?>
																		<div class="attribute-name-val <?php echo ($i == 0) ? 'ithoughts-prototype' : ''; ?>">
																			<div class="kv-pair"> 
																				<label for="attributes-link-key-<?php echo $i; ?>" class="dynamicId dynamicId-key"> 
																					<?php _e("Key", 'ithoughts-tooltip-glossary' ); ?> 
																				</label> 
																				<input type="text" <?php echo ($i == 0) ? 'disabled' : ''; ?> class="dynamicId dynamicId-key" value="<?php echo $key; ?>" autocomplete="off" list="attributes-list" name="attributes-link-key[]" id="attributes-link-key-<?php echo $i; ?>" /> 
																			</div> 
																			<div class="kv-pair"> 
																				<label for="attributes-link-value-<?php echo $i; ?>" class="dynamicId dynamicId-value"> 
																					<?php _e("Value", 'ithoughts-tooltip-glossary' ); ?> 
																				</label> 
																				<input type="text" <?php echo ($i == 0) ? 'disabled' : ''; ?> class="dynamicId dynamicId-value" value="<?php echo $value; ?>" autocomplete="off" name="attributes-link-value[]" id="attributes-link-value-<?php echo $i; ?>" /> 
																			</div> 
																		</div>
																		<?php $i++;
																		} ?>
																	</div>
																	<div style="clear:both;"></div> 
																	<button type="button" id="kv-pair-link-attrs-add" class="button button-primary button-large"><?php _e("Add", 'ithoughts-tooltip-glossary' ); ?></button> 
																</div> 
															</div> 
														</div> 
													</div>
												</td> 
											</tr>
										</table>
									</div> 
								</div>
							</div>
						</form> 
					</div> 
				</div> 
			</div> 
			<div class="mce-container mce-panel mce-foot"tabindex="-1"> 
				<div class="mce-container-body"> 
					<div> 
					</div> 
					<div  class="mce-widget mce-btn mce-primary mce-first mce-btn-has-text" role="button" tabindex="-1"> 
						<button role="presentation" style="height: 100%; width: 100%;" tabindex="-1" type="button" id="ithoughts_tt_gl-tinymce-validate-attrs"> 
							<?php _e("Ok", 'ithoughts-tooltip-glossary' ); ?> 
						</button> 
					</div> 
					<div  class="mce-widget mce-btn mce-last mce-btn-has-text" role="button" tabindex="-1"> 
						<button role="presentation" style="height: 100%; width: 100%;" tabindex="-1" type="button" id="ithoughts_tt_gl-tinymce-close-attrs"> 
							<?php _e("Close", 'ithoughts-tooltip-glossary' ); ?> 
						</button> 
					</div> 
				</div> 
			</div> 
		</div> 
	</div>
	<div style="z-index: 100100;" id="mce-modal-block" class="mce-reset mce-fade mce-in">
	</div>
</div>