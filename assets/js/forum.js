/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function () {
    forum.init();
});

forum = function () {
    return {
        init: function () {

            forum.addEvents(jQuery('body'));

        }, addEvents: function (html) {

            html.find(".forums-navigation a").on('click', function (event) {
                forum.loadForums(jQuery(this));
            });

            return html;

        }, loadForums: function (this_element) {

            var action = this_element.attr('action');
            var offset = this_element.attr('offset');
            var forum_id = this_element.attr('forum_id');
            var data_object = {forum_id: forum_id, action: action, offset: offset};

            var form = kazist.callAjaxByRoute('forum.forum.ajaxloadforums', data_object, true);

            jQuery('.forum-categories-listing').html(form);

            forum.addEvents(jQuery('.forum-categories-listing'));
        }

    };
}();