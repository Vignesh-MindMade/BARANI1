$(function () {

  var width = $(window).width();

  if (width <= 991) return;

  const container = document.querySelector(".thecontainer");
  const sections = gsap.utils.toArray(".panel");

  // stop if elements don't exist
  if (!container || sections.length === 0) return;

  gsap.registerPlugin(ScrollTrigger);

  gsap.to(sections, {
    xPercent: -100 * (sections.length - 1),
    ease: "none",
    scrollTrigger: {
      trigger: container,
      pin: true,
      scrub: 1,
      end: () => "+=" + container.offsetWidth
    }
  });

});