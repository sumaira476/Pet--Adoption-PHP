document.getElementById('contactForm').addEventListener('submit', function (e) {
    e.preventDefault();
    alert('Thank you for contacting us! We will get back to you soon.');
  });
  function toggleLike(button) {
    const heartIcon = button.querySelector('.heart-icon');
    button.classList.toggle('active');
    button.textContent = button.classList.contains('active') ? ' Liked' : ' Like';
    button.prepend(heartIcon); // Keep heart icon at start
}

  