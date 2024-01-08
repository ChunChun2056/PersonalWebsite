var hamburgerIcon = document.querySelector(".hamburger").querySelector(".hamburger-icon");

hamburgerIcon.addEventListener("click", (event) => {
  const nav = document.querySelector(".nav-items");
  var navStyle = nav.dataset.menustyle;
  nav.dataset.menustyle = navStyle == "closed" ? "opened" : "closed";
  console.log("Working")
});