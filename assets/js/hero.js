// HERO SECTION SCROLL FUNCTIONS

function scrollToContact() {
  const contactSection = document.getElementById("contact");
  if(contactSection) {
    contactSection.scrollIntoView({ behavior: "smooth" });
  }
}

function scrollToPortfolio() {
  const portfolioSection = document.getElementById("portfolio");
  if(portfolioSection) {
    portfolioSection.scrollIntoView({ behavior: "smooth" });
  }
}

// Pokud chceš, můžeš odkomentovat a připojit na tlačítka přes JS
// document.querySelector('.button.primary').addEventListener('click', scrollToContact);
// document.querySelector('.button.outline').addEventListener('click', scrollToPortfolio);