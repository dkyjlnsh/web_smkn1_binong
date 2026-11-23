document.addEventListener("DOMContentLoaded", () => {
  // ---- Render Semua Ikon Lucide ----
  if (typeof lucide !== "undefined") {
    lucide.createIcons();
  }

  // ---- Sticky header shadow & Scroll Progress Bar ----
  const header = document.getElementById("siteHeader");
  const progressBar = document.getElementById("progress-bar");

  window.addEventListener("scroll", () => {
    if (header) {
      header.classList.toggle("scrolled", window.scrollY > 10);
    }
    if (progressBar) {
      const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
      const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      const scrolled = height > 0 ? (winScroll / height) * 100 : 0;
      progressBar.style.width = scrolled + "%";
    }
  });

  // ---- Hamburger / mobile menu ----
  const hamburgerBtn = document.getElementById("hamburgerBtn");
  const navMenu = document.getElementById("navMenu");
  const menuOverlay = document.getElementById("menuOverlay");

  function toggleMenu(forceClose) {
    if (!navMenu || !hamburgerBtn || !menuOverlay) return;
    const willOpen = forceClose ? false : !navMenu.classList.contains("open");
    navMenu.classList.toggle("open", willOpen);
    hamburgerBtn.classList.toggle("active", willOpen);
    hamburgerBtn.setAttribute("aria-expanded", String(willOpen));
    menuOverlay.classList.toggle("active", willOpen);
    document.body.style.overflow = willOpen ? "hidden" : "";
  }

  if (hamburgerBtn) hamburgerBtn.addEventListener("click", () => toggleMenu());
  if (menuOverlay) menuOverlay.addEventListener("click", () => toggleMenu(true));

  // ---- Smooth scroll helper ----
  function smoothScrollTo(targetId) {
    const target = document.querySelector(targetId);
    if (target) {
      const offset = 72;
      const top = target.getBoundingClientRect().top + window.scrollY - offset;
      window.scrollTo({ top, behavior: "smooth" });
    }
  }

  document.querySelectorAll(".nav-link").forEach((link) => {
    link.addEventListener("click", (e) => {
      const targetId = link.getAttribute("href");
      if (targetId && targetId.startsWith("#")) {
        e.preventDefault();
        toggleMenu(true);
        smoothScrollTo(targetId);
      }
    });
  });

  // ---- Animated Stats Counter ----
  const counters = document.querySelectorAll(".count-up");
  const counterObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const target = +entry.target.getAttribute("data-target");
          const countProgress = () => {
            const current = +entry.target.innerText.replace(/\D/g, "");
            const increment = Math.max(1, Math.ceil(target / 40));
            if (current < target) {
              entry.target.innerText = Math.min(target, current + increment);
              setTimeout(countProgress, 25);
            } else {
              entry.target.innerText = target;
            }
          };
          countProgress();
          counterObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.5 }
  );
  counters.forEach((c) => counterObserver.observe(c));

  // ---- Scroll-reveal animation ----
  const revealEls = document.querySelectorAll(".reveal");
  const revealObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
          revealObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.15, rootMargin: "0px 0px -60px 0px" }
  );

  revealEls.forEach((el, i) => {
    el.style.transitionDelay = (i % 4) * 0.08 + "s";
    revealObserver.observe(el);
  });

  // ---- Contact form (demo) ----
  const contactForm = document.getElementById("contactForm");
  const formMsg = document.getElementById("formMsg");
  if (contactForm && formMsg) {
    contactForm.addEventListener("submit", (e) => {
      e.preventDefault();
      formMsg.classList.add("show");
      contactForm.reset();
      setTimeout(() => formMsg.classList.remove("show"), 4000);
    });
  }

  // ---- FAQ Accordion ----
  document.querySelectorAll(".faq-question").forEach((button) => {
    button.addEventListener("click", () => {
      const item = button.parentElement;
      document.querySelectorAll(".faq-item").forEach((otherItem) => {
        if (otherItem !== item) otherItem.classList.remove("active");
      });
      item.classList.toggle("active");
    });
  });

  // ---- ENGINE KUIS REKOMENDASI JURUSAN ----
  const quizData = [
    {
      question: "Kategori aktivitas apa yang paling bikin kamu bersemangat?",
      options: [
        { text: "Bikin aplikasi, mendesain web, atau membuat game komputer.", score: "pplg" },
        { text: "Mengatur laporan keuangan, menghitung angka, dan pembukuan.", score: "akl" },
        { text: "Membongkar mesin motor atau memodifikasi komponen otomotif.", score: "tbsm" },
        { text: "Mengelola persuratan, mengetik cepat, dan mengatur jadwal kegiatan.", score: "mplb" }
      ]
    },
    {
      question: "Bagaimana cara kamu menyelesaikan suatu masalah teknis?",
      options: [
        { text: "Mencari logika atau algoritma yang salah dalam susunan kode.", score: "pplg" },
        { text: "Menganalisis sistem kelistrikan & merakit sirkuit kontrol otomatis.", score: "tei" },
        { text: "Meneliti kondisi tanah, nutrisi tanaman, serta sistem pengairan.", score: "atph" },
        { text: "Menyusun strategi alur kerja kantor secara rapi dan sistematis.", score: "mplb" }
      ]
    },
    {
      question: "Jika diberi proyek bebas, kamu lebih memilih untuk membuat...",
      options: [
        { text: "Sistem otomasi pabrik pintar atau robotik mandiri.", score: "tei" },
        { text: "Kebun hidroponik modern berbasis agribisnis berkelanjutan.", score: "atph" },
        { text: "Bengkel servis motor komersial berskala besar.", score: "tbsm" },
        { text: "Aplikasi e-commerce atau game petualangan buatan sendiri.", score: "pplg" }
      ]
    },
    {
      question: "Lingkungan kerja seperti apa yang paling kamu impikan nanti?",
      options: [
        { text: "Di dalam kantor startup teknologi yang santai namun dinamis.", score: "pplg" },
        { text: "Di kantor perbankan nasional atau instansi keuangan terkemuka.", score: "akl" },
        { text: "Di bengkel manufaktur resmi otomotif bersertifikat.", score: "tbsm" },
        { text: "Di area lahan perkebunan modern terpadu bernilai tinggi.", score: "atph" }
      ]
    }
  ];

  const targetJurusan = {
    pplg: { title: "PPLG (Pengembangan Perangkat Lunak & Gim)", desc: "Kamu memiliki logika pemecahan masalah yang kuat serta ketertarikan tinggi pada dunia coding dan pembuatan sistem digital." },
    akl: { title: "AKL (Akuntansi & Keuangan Lembaga)", desc: "Kamu sangat detail, teliti, dan menyukai manajemen data numerik serta analisis keuangan yang presisi." },
    tbsm: { title: "TBSM (Teknik Bisnis Sepeda Motor)", desc: "Kamu adalah tipe orang praktikal yang gemar bekerja langsung dengan mesin mekanik dan dunia otomotif." },
    mplb: { title: "MPLB (Manajemen Perkantoran & Layanan Bisnis)", desc: "Kamu berbakat dalam manajemen operasional, komunikasi bisnis, serta penataan arsip kerja profesional." },
    atph: { title: "ATPH (Agribisnis Tanaman Pangan & Hortikultura)", desc: "Kamu peduli pada ketahanan pangan modern, botani, serta prospek wirausaha hijau masa depan." },
    tei: { title: "TEI (Teknik Elektronika Industri)", desc: "Kamu menyukai teknologi kelistrikan canggih, otomasi pabrik, mikrokontroler, dan perakitan robot industri." }
  };

  let currentQuizIndex = 0;
  let quizScores = {};
  let latestRecommendedTitle = "";

  const startQuizBtn = document.getElementById("startQuizBtn");
  const resetQuizBtn = document.getElementById("resetQuizBtn");
  const quizCtaLink = document.getElementById("quizCtaLink");
  const quizStartView = document.getElementById("quizStartView");
  const quizQuestionView = document.getElementById("quizQuestionView");
  const quizResultView = document.getElementById("quizResultView");
  const quizQuestionText = document.getElementById("quizQuestionText");
  const quizOptionsContainer = document.getElementById("quizOptionsContainer");
  const quizStepIndicator = document.getElementById("quizStepIndicator");
  const quizProgressFill = document.getElementById("quizProgressFill");
  const resultTitle = document.getElementById("resultTitle");
  const resultDesc = document.getElementById("resultDesc");

  if (startQuizBtn) {
    startQuizBtn.addEventListener("click", () => {
      quizStartView.classList.remove("active");
      quizQuestionView.classList.add("active");
      showQuizQuestion();
    });
  }

  function showQuizQuestion() {
    const currentQuestion = quizData[currentQuizIndex];
    quizStepIndicator.innerText = `Soal ${currentQuizIndex + 1} dari ${quizData.length}`;
    quizProgressFill.style.width = `${((currentQuizIndex + 1) / quizData.length) * 100}%`;
    quizQuestionText.innerText = currentQuestion.question;

    quizOptionsContainer.innerHTML = "";
    currentQuestion.options.forEach((opt) => {
      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = "quiz-opt-btn";
      btn.innerText = opt.text;
      btn.addEventListener("click", () => handleQuizAnswer(opt.score));
      quizOptionsContainer.appendChild(btn);
    });
  }

  function handleQuizAnswer(scoreKey) {
    quizScores[scoreKey] = (quizScores[scoreKey] || 0) + 1;
    currentQuizIndex++;

    if (currentQuizIndex < quizData.length) {
      showQuizQuestion();
    } else {
      showQuizResult();
    }
  }

  function showQuizResult() {
    quizQuestionView.classList.remove("active");
    quizResultView.classList.add("active");

    let highestScore = 0;
    let recommendedJurusan = "pplg";

    for (const key in quizScores) {
      if (quizScores[key] > highestScore) {
        highestScore = quizScores[key];
        recommendedJurusan = key;
      }
    }

    const result = targetJurusan[recommendedJurusan];
    latestRecommendedTitle = result.title;
    resultTitle.innerText = result.title;
    resultDesc.innerText = result.desc;
  }

  if (quizCtaLink) {
    quizCtaLink.addEventListener("click", (e) => {
      e.preventDefault();
      const pesanInput = document.getElementById("pesan");
      if (pesanInput && latestRecommendedTitle) {
        pesanInput.value = `Halo Admin SMKN 1 Binong, berdasarkan hasil kuis minat, saya tertarik untuk mendaftar di jurusan ${latestRecommendedTitle}. Mohon informasi syarat pendaftarannya.`;
      }
      smoothScrollTo("#kontak");
    });
  }

  if (resetQuizBtn) {
    resetQuizBtn.addEventListener("click", () => {
      currentQuizIndex = 0;
      quizScores = {};
      latestRecommendedTitle = "";
      if (quizProgressFill) quizProgressFill.style.width = "0%";
      quizResultView.classList.remove("active");
      quizStartView.classList.add("active");
    });
  }
});