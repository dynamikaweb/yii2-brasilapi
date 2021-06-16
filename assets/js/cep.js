/*!
 * jQuery CEP
 * Released under the MIT license.
 */
(function ($) {
    var Cep = function ($element, options) {
        this.init($element, options);
    };

    Cep.prototype = {
        constructor: Cep,

        init: function (element, options) {
            this.element = element;
            this.root = this.element.parent();
            this.action = options.action;
            this.fields = options.fields;
            this.template = options.template;
            var that = this;

            this.element.on('change', function(){
                
                that.search($(this), true);
            });

            this.element.on('keydown', function(e){
                if (e.which == '13') {
                    e.preventDefault();
                    that.search($(this), true);
                }
            });
        },

        _assign: function (data) {
            if (!$.isEmptyObject(data)) {
                this.element.trigger($.Event('beforeAssignData'), [data]);
                for (var prop in this.fields) {
                    var input = jQuery('#' + this.fields[prop]);
                    if (input.length) {
                        if (prop in data) {
                            input.val(data[prop]);
                            input.parent().trigger('change');
                        } else {
                            input.val('');
                        }
                    }
                }
                this.element.trigger($.Event('afterAssignData'), [data]);
            }
        },

        search: function ($button, cep) {
            var val = this.element.val(),
                template = this.template;
                that = this;

            if (!val) {
                return;
            }
            val = val.replace(/[^0-9]/g, '');

            if (val) {
                var action = this.action + val;
                
                $.ajax({
                    url: action,
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData:false,
                    dataType: 'json',
                    beforeSend: function(){
                        $.LoadingOverlay("show");
                    },
                    success: function(result) {
                        if (result.success) {
                            that._assign(result.data);
                        }
                        return false;
                    },
                    error: function(error) {
                    },
                    complete: function() {
                        if(template == 'materialize'){
                            M.updateTextFields();
                            $('select').formSelect();
                        }
                        $.LoadingOverlay("hide");
                    }
                });
            }
        }
    };

    $.fn.cep = function(options){
        return this.each(function(){
            var elem = $(this),
                data = elem.data('cep');

            if (!data) {
                elem.data('cep', new Cep(elem, options));
            }
        });
    };

})(jQuery);