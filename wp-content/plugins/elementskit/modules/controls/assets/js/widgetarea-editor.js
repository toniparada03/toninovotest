(function(e,t){'use strict';var n={init:function(){t.hooks.addAction('frontend/element_ready/global',function(t){var a=t.find('.widgetarea_warper_edit');a.on('click',function(){var t=window.parent.$('#widgetarea-control-iframe'),a=window.parent.$('#elementor-template-library-modal'),n=e(this).parent().attr('data-elementskit-widgetarea-key'),i=e(this).parent().attr('data-elementskit-widgetarea-index'),o=window.elementskit.resturl+'dynamic-content/content_editor/widget/'+n+'-'+i;window.parent.$('body').attr('data-elementskit-widgetarea-key',n);window.parent.$('body').attr('data-elementskit-widgetarea-load','false');a.css('display','block');window.parent.$('.widgetarea_iframe_modal').css('display','block');window.parent.$('.dialog-lightbox-loading').css('display','block');t.contents().find('#elementor-loading').css('display','block');t.css('z-index','-1');t.attr('src',o);t.on('load',function(){window.parent.$('.dialog-lightbox-loading').css('display','none');t.css('display','block');t.contents().find('#elementor-loading').css('display','none');t.css('z-index','1')})});if(typeof window.parent.$!='undefined'){var n=window.parent.$('#elementor-template-library-modal').find('.eicon-close');n.on('click',function(){window.parent.$('body').attr('data-elementskit-widgetarea-load','true')})}})},};e(window).on('elementor/frontend/init',n.init)}(jQuery,window.elementorFrontend));