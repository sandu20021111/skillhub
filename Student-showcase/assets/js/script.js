console.log('Project Showcase Loaded');

console.log("Dashboard loaded successfully.");

function showPopup(project) {
    document.getElementById('popup-title').textContent = project.title;
    document.getElementById('popup-desc').textContent = project.description;
    document.getElementById('popup-cat').textContent = project.category;
    document.getElementById('popup-link').href = project.github_url || '#';
    document.getElementById('popup-link').textContent = project.github_url ? "Visit Project" : "No URL";

    if (project.image_path) {
        document.getElementById('popup-image').innerHTML = `<img src="${project.image_path}" alt="Project Image">`;
    } else {
        document.getElementById('popup-image').innerHTML = '';
    }

    document.getElementById('popup').style.display = 'flex';
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

function filterProjects() {
  const input = document.getElementById('searchInput');
  const filter = input.value.toLowerCase();
  const cards = document.querySelectorAll('.grid .card');

  cards.forEach(card => {
    const title = card.querySelector('h3').textContent.toLowerCase();
    const creator = card.querySelector('.creator').textContent.toLowerCase();
    
    if (title.includes(filter) || creator.includes(filter)) {
      card.style.display = '';
    } else {
      card.style.display = 'none';
    }
  });
}



//like
function likeProject(projectId) {
  fetch('like.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'project_id=' + projectId
  })
  .then(res => res.json())
  .then(data => {
    document.getElementById('like-count').textContent = data.count;
    const btn = document.getElementById('like-btn');
    btn.classList.toggle('liked', data.liked);
  });
}
const openContactBtn = document.getElementById('openContactBtn');
    const closeContactBtn = document.getElementById('closeContactBtn');
    const contactModal = document.getElementById('contactModal');

    if(openContactBtn && closeContactBtn && contactModal) {
      openContactBtn.addEventListener('click', () => {
        contactModal.style.display = 'block';
        contactModal.setAttribute('aria-hidden', 'false');
      });

      closeContactBtn.addEventListener('click', () => {
        contactModal.style.display = 'none';
        contactModal.setAttribute('aria-hidden', 'true');
      });

      window.addEventListener('click', (e) => {
        if (e.target === contactModal) {
          contactModal.style.display = 'none';
          contactModal.setAttribute('aria-hidden', 'true');
        }
      });
    }

document.addEventListener('DOMContentLoaded', () => {
  console.log("All Projects page loaded.");

  
});

//product details
document.addEventListener('DOMContentLoaded', () => {
  console.log("Project details page ready.");
});

document.addEventListener('DOMContentLoaded', () => {
  const forms = document.querySelectorAll('form.auto-clear');

  forms.forEach(form => {
    form.addEventListener('submit', () => {
      setTimeout(() => {
        form.reset();
      }, 500); 
    });
  });
});


document.addEventListener("DOMContentLoaded", () => {
  const openBtn = document.getElementById("openContactBtn");
  const modal = document.getElementById("contactModal");
  const closeBtn = document.getElementById("closeContactBtn");

  if (openBtn && modal && closeBtn) {
    openBtn.addEventListener("click", () => {
      modal.style.display = "block";
      modal.setAttribute("aria-hidden", "false");
    });

    closeBtn.addEventListener("click", () => {
      modal.style.display = "none";
      modal.setAttribute("aria-hidden", "true");
    });

    window.addEventListener("click", (event) => {
      if (event.target === modal) {
        modal.style.display = "none";
        modal.setAttribute("aria-hidden", "true");
      }
    });

    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && modal.style.display === "block") {
        modal.style.display = "none";
        modal.setAttribute("aria-hidden", "true");
      }
    });
  }
});

