/*
 in-viewport v0.4.0 | github.com/vvo/in-viewport#license
*/
(function(g, k) {
  function q(b, a, e) {
    b.attachEvent ? b.attachEvent("on" + a, e) : b.addEventListener(a, e, !1)
  }

  function s(b) {
    var a;
    return function() {
      var e = this,
        d = arguments;
      clearTimeout(a);
      a = setTimeout(function() {
        a = null;
        b.apply(e, d)
      }, 15)
    }
  }

  function t(b) {
    function a(a, d, c) {
      if (!r(k.documentElement, a) || !r(k.documentElement, b)) return c ? setTimeout(e(a, d, c), 0) : !1;
      var l = a.getBoundingClientRect(),
        h = b.getBoundingClientRect(),
        g = l.left,
        l = l.top,
        m = d,
        n = d;
      b === k.body ? (m += k.documentElement.clientWidth, n += k.documentElement.clientHeight) :
        (g -= h.left, l -= h.top, m += b.clientWidth, n += b.clientHeight);
      if (g >= -d && g <= m && l >= -d && l <= n)
        if (c) f.splice(p.call(f, a), 1), c(a);
        else return !0;
        else
      if (c) setTimeout(e(a, d, c), 0);
      else return !1
    }

    function e(b, c, e) {
      -1 === p.call(f, b) && f.push(b);
      return function() {
        d.push(function() {
          a(b, c, e)
        })
      }
    }
    var d = [],
      f = [],
      c = b === k.body ? g : b,
      h = s(function() {
        for (var a; a = d.shift();) a()
      });
    q(c, "scroll", h);
    c === g && q(g, "resize", h);
    "function" === typeof window.MutationObserver && u(f, b, h);
    return {
      b: b,
      a: a
    }
  }

  function p(b) {
    for (var a = this.length; a-- && this[a] !==
      b;);
    return a
  }

  function u(b, a, c) {
    function d(a) {
      return -1 !== p.call(b, a)
    }

    function f(a) {
      return 0 < h.call(a.addedNodes, d).length
    }
    var g = new MutationObserver(function(a) {
      !0 === a.some(f) && setTimeout(c, 0)
    }),
      h = Array.prototype.filter;
    g.observe(a, {
      childList: !0,
      subtree: !0
    })
  }
  var c = [];
  g.inViewport = function(b, a, e) {
    var d = k.body;
    if (void 0 === a || "function" === typeof a) e = a, a = {};
    d = a.container || d;
    a = a.offset || 0;
    for (var f = 0; f < c.length; f++)
      if (c[f].b === d) return c[f].a(b, a, e);
    return c[c.push(t(d)) - 1].a(b, a, e)
  };
  var r = document.documentElement.compareDocumentPosition ?
    function(b, a) {
      return !!(b.compareDocumentPosition(a) & 16)
  } : document.documentElement.contains ? function(b, a) {
    return b !== a && (b.contains ? b.contains(a) : !1)
  } : function(b, a) {
    for (; a = a.parentNode;)
      if (a === b) return !0;
    return !1
  }
})(window, document);