/* ========================================================================
 * Bootstrap: Modal.js v3.0.0
 * http://twbs.github.com/bootstrap/javascript.html#modals
 * ======================================================================== */

+function ($) { "use strict";

  // MODAL CLASS DEFINITION
  // ======================

  var Gumodal = function (element, options) {
    this.options   = options
    this.$element  = $(element)
    this.$backdrop =
    this.isShown   = null

    if (this.options.remote) this.$element.load(this.options.remote)
  }

  Gumodal.DEFAULTS = {
      backdrop: true
    , keyboard: true
    , show: true
  }

  Gumodal.prototype.toggle = function (_relatedTarget) {
    return this[!this.isShown ? 'show' : 'hide'](_relatedTarget)
  }

  Gumodal.prototype.show = function (_relatedTarget) {
    var that = this
    var e    = $.Event('show.bs.mlmodal', { relatedTarget: _relatedTarget })

    this.$element.trigger(e)

    if (this.isShown || e.isDefaultPrevented()) return

    this.isShown = true

    this.escape()

    this.$element.on('click.dismiss.mlmodal', '[data-dismiss="ml-modal"]', $.proxy(this.hide, this))

    this.backdrop(function () {
      var transition = $.support.transition && that.$element.hasClass('fade')

      if (!that.$element.parent().length) {
        that.$element.appendTo(document.body) // don't move Gumodals dom position
      }

      that.$element.show()

      if (transition) {
        that.$element[0].offsetWidth // force reflow
      }

      that.$element
        .addClass('ml-in')
        .attr('aria-hidden', false)

      that.enforceFocus()

      var e = $.Event('shown.bs.mlmodal', { relatedTarget: _relatedTarget })

      transition ?
        that.$element.find('.modal-login-dialog') // wait for Gumodal to slide in
          .one($.support.transition.end, function () {
            that.$element.focus().trigger(e)
          })
          .emulateTransitionEnd(300) :
        that.$element.focus().trigger(e)
    })
  }

  Gumodal.prototype.hide = function (e) {
    if (e) e.preventDefault()

    e = $.Event('hide.bs.mlmodal')

    this.$element.trigger(e)

    if (!this.isShown || e.isDefaultPrevented()) return

    this.isShown = false

    this.escape()

    $(document).off('focusin.bs.mlmodal')

    this.$element
      .removeClass('ml-in')
      .attr('aria-hidden', true)
      .off('click.dismiss.mlmodal')

    $.support.transition && this.$element.hasClass('fade') ?
      this.$element
        .one($.support.transition.end, $.proxy(this.hideModal, this))
        .emulateTransitionEnd(300) :
      this.hideModal()
  }

  Gumodal.prototype.enforceFocus = function () {
    $(document)
      .off('focusin.bs.mlmodal') // guard against infinite focus loop
      .on('focusin.bs.mlmodal', $.proxy(function (e) {
        if (this.$element[0] !== e.target && !this.$element.has(e.target).length) {
          this.$element.focus()
        }
      }, this))
  }

  Gumodal.prototype.escape = function () {
    if (this.isShown && this.options.keyboard) {
      this.$element.on('keyup.dismiss.bs.mlmodal', $.proxy(function (e) {
        e.which == 27 && this.hide()
      }, this))
    } else if (!this.isShown) {
      this.$element.off('keyup.dismiss.bs.mlmodal')
    }
  }

  Gumodal.prototype.hideModal = function () {
    var that = this
    this.$element.hide()
    this.backdrop(function () {
      that.removeBackdrop()
      that.$element.trigger('hidden.bs.mlmodal')
    })
  }

  Gumodal.prototype.removeBackdrop = function () {
    this.$backdrop && this.$backdrop.remove()
    this.$backdrop = null
  }

  Gumodal.prototype.backdrop = function (callback) {
    var that    = this
    var animate = this.$element.hasClass('fade') ? 'fade' : ''

    if (this.isShown && this.options.backdrop) {
      var doAnimate = $.support.transition && animate

      this.$backdrop = $('<div class="modal-login-backdrop ' + animate + '" />')
        .appendTo(document.body)

      this.$element.on('click.dismiss.mlmodal', $.proxy(function (e) {
        if (e.target !== e.currentTarget) return
        this.options.backdrop == 'static'
          ? this.$element[0].focus.call(this.$element[0])
          : this.hide.call(this)
      }, this))

      if (doAnimate) this.$backdrop[0].offsetWidth // force reflow

      this.$backdrop.addClass('ml-in')

      if (!callback) return

      doAnimate ?
        this.$backdrop
          .one($.support.transition.end, callback)
          .emulateTransitionEnd(150) :
        callback()

    } else if (!this.isShown && this.$backdrop) {
      this.$backdrop.removeClass('ml-in')

      $.support.transition && this.$element.hasClass('fade')?
        this.$backdrop
          .one($.support.transition.end, callback)
          .emulateTransitionEnd(150) :
        callback()

    } else if (callback) {
      callback()
    }
  }


  // GumODAL PLUGIN DEFINITION
  // =======================

  var old = $.fn.mlmodal

  $.fn.mlmodal = function (option, _relatedTarget) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.mlmodal')
      var options = $.extend({}, Gumodal.DEFAULTS, $this.data(), typeof option == 'object' && option)

      if (!data) $this.data('bs.mlmodal', (data = new Gumodal(this, options)))
      if (typeof option == 'string') data[option](_relatedTarget)
      else if (options.show) data.show(_relatedTarget)
    })
  }

  $.fn.mlmodal.Constructor = Gumodal


  // GumODAL NO CONFLICT
  // =================

  $.fn.mlmodal.noConflict = function () {
    $.fn.mlmodal = old
    return this
  }


  // GumODAL DATA-API
  // ==============

  $(document).on('click.bs.mlmodal.data-api', '[data-toggle="ml-modal"]', function (e) {
    var $this   = $(this)
    var href    = $this.attr('href')
    var $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, ''))) //strip for ie7
    var option  = $target.data('ml-modal') ? 'toggle' : $.extend({ remote: !/#/.test(href) && href }, $target.data(), $this.data())

    e.preventDefault()

    $target
      .mlmodal(option, this)
      .one('hide', function () {
        $this.is(':visible') && $this.focus()
      })
  })

  $(document)
    .on('show.bs.mlmodal',  '.ml-modal', function () { $(document.body).addClass('modal-open') })
    .on('hidden.bs.mlmodal', '.ml-modal', function () { $(document.body).removeClass('modal-open') })

}(window.jQuery);


/* ========================================================================
 * Bootstrap: transition.js v3.0.0
 * http://twbs.github.com/bootstrap/javascript.html#transitions
 * ======================================================================== */


+function ($) { "use strict";

  // CSS TRANSITION SUPPORT (Shoutout: http://www.modernizr.com/)
  // ============================================================

  function transitionEnd() {
    var el = document.createElement('bootstrap')

    var transEndEventNames = {
      'WebkitTransition' : 'webkitTransitionEnd'
    , 'MozTransition'    : 'transitionend'
    , 'OTransition'      : 'oTransitionEnd otransitionend'
    , 'transition'       : 'transitionend'
    }

    for (var name in transEndEventNames) {
      if (el.style[name] !== undefined) {
        return { end: transEndEventNames[name] }
      }
    }
  }

  // http://blog.alexmaccaw.com/css-transitions
  $.fn.emulateTransitionEnd = function (duration) {
    var called = false, $el = this
    $(this).one($.support.transition.end, function () { called = true })
    var callback = function () { if (!called) $($el).trigger($.support.transition.end) }
    setTimeout(callback, duration)
    return this
  }

  $(function () {
    $.support.transition = transitionEnd()
  })

}(window.jQuery);

