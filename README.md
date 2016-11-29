FOIL
======

> PHP template engine, for PHP templates.

-------

[![travis-ci status](https://img.shields.io/travis/FoilPHP/Foil.svg?style=flat-square)](https://travis-ci.org/FoilPHP/Foil)
[![codecov.io](https://img.shields.io/codecov/c/github/FoilPHP/Foil.svg?style=flat-square)](http://codecov.io/github/FoilPHP/Foil?branch=master)
[![license](https://img.shields.io/packagist/l/foil/foil.svg?style=flat-square)](http://opensource.org/licenses/MIT)
[![release](https://img.shields.io/github/release/FoilPHP/foil.svg?style=flat-square)](https://github.com/FoilPHP/Foil/releases/latest)

-------

**Foil** brings all the flexibility and power of modern template engines to native PHP templates. Write simple, clean and concise templates with nothing more than PHP.

# Key Features

 - Templates inheritance (you'll never miss Twig or Blade)
 - Clean, concise and DRY templates
 - Dozen of ready-made helper functions and filters
 - Easily extensible and customizable
 - Multiple template folders with file auto-discover or custom picking
 - Auto or manual data escape
 - Powerful context API (preassign data to templates using conditions)
 - Framework agnostic, centralized API for very easy integration
 - Composer ready, fully unit and functional tested, PSR-1/2/4 compliant

...and many more


# Why?

Template engines like Twig, or Blade are a great thing, really. However, to use them, one needs to learn another *language* with its own syntax and rules. Moreover, with compiled engines, one needs to write an engine extension to use even a simple PHP function.

In truth, PHP is already a templating language, but honestly it's not a good one, because it's missing pivotal features of modern template engines, like template inheritance.

## Why not Plates?

Then, I discovered [Plates](http://platesphp.com/), and it was love at first sight. But that kind of love rarely lasts a lifetime.

Trying to do something *serious* with Plates, I encountered several problems which I didn't have when using compiled template engines.

I wrote [a blog post](http://gm.zoomlab.it/2015/template-engines-i-moved-from-love-to-meh-for-plates/) to explain why I am not happy with Plates anymore, which is the reason I decided to write Foil.

# Requirements

Foil is framework agnostic. The only thing needed is PHP 5.4+ and Composer to add Foil to your PHP project.

---

# Backward Incompatibility Notice

Foil version **0.6** introduced backward incompatibility changes. The mechanism for internal objects changed a lot, but
core features and template functions especially were not affected.

Please see [v0.6 release notes](https://github.com/FoilPHP/Foil/releases/tag/0.6.0) to find more on the topic.

---

# License

Foil is open source and released under MIT license. See LICENSE file for more info.

# Question? Issues?

Foil is hosted on GitHub. Feel free to open issues there for suggestions, questions and real issues.

# Who's Behind Foil

I'm Giuseppe, I've dealt with PHP since 2005. For questions, rants or chat ping me on Twitter ([@gmazzap](https://twitter.com/gmazzap)) or on ["The Loop"](http://chat.stackexchange.com/rooms/6/the-loop) (Stack Exchange) chat. (Well, it's possible I'll ignore rants.)
