document.addEventListener("DOMContentLoaded", function() {
const accordions = document.querySelectorAll(".block--accordions__trigger");

accordions.forEach(trigger => {
trigger.addEventListener("click", function() {
const isExpanded = this.getAttribute("aria-expanded") === "true";
const content = document.getElementById(this.getAttribute("aria-controls"));

// Toggle current accordion
this.setAttribute("aria-expanded", !isExpanded);
content.hidden = isExpanded;
});
});
});
