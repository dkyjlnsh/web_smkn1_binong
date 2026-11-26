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

  // ---- Auto-hide notifikasi sukses kirim pesan ----
  const formMsg = document.getElementById("formMsg");
  if (formMsg && formMsg.classList.contains("show")) {
    setTimeout(() => formMsg.classList.remove("show"), 5000);
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

  // ---- ENGINE KUIS REKOMENDASI JURUSAN (DINAMIS) ----
  const fallbackJurusanList = [
    {
      id: "pplg",
      kode: "PPLG",
      nama: "Pengembangan Perangkat Lunak & Gim",
      deskripsi: "Kamu memiliki logika pemecahan masalah yang kuat serta ketertarikan tinggi pada dunia coding dan pembuatan sistem digital."
    },
    {
      id: "akl",
      kode: "AKL",
      nama: "Akuntansi & Keuangan Lembaga",
      deskripsi: "Kamu sangat detail, teliti, dan menyukai manajemen data numerik serta analisis keuangan yang presisi."
    },
    {
      id: "tbsm",
      kode: "TBSM",
      nama: "Teknik Bisnis Sepeda Motor",
      deskripsi: "Kamu adalah tipe orang praktikal yang gemar bekerja langsung dengan mesin mekanik dan dunia otomotif."
    },
    {
      id: "mplb",
      kode: "MPLB",
      nama: "Manajemen Perkantoran & Layanan Bisnis",
      deskripsi: "Kamu berbakat dalam manajemen operasional, komunikasi bisnis, serta penataan arsip kerja profesional."
    }
  ];

  const jurusanSource =
    Array.isArray(window.STARBIN_JURUSANS) && window.STARBIN_JURUSANS.length > 0
      ? window.STARBIN_JURUSANS
      : fallbackJurusanList;

  const targetJurusan = {};
  jurusanSource.forEach((j) => {
    const key = String(j.id);
    const fullTitle =
      j.kode && !String(j.nama).toUpperCase().includes(String(j.kode).toUpperCase())
        ? `${j.kode} (${j.nama})`
        : j.nama;

    let fullDesc = j.deskripsi || "Kompetensi keahlian ini sesuai dengan minat dan potensi yang kamu pilih.";
    if (j.prospek && String(j.prospek).trim() !== "") {
      fullDesc += ` Prospek karir: ${String(j.prospek).trim()}.`;
    }

    targetJurusan[key] = {
      title: fullTitle,
      desc: fullDesc
    };
  });

  const defaultJurusanKey = Object.keys(targetJurusan)[0] || "pplg";

  const dbQuizSoals =
    Array.isArray(window.STARBIN_KUIS_SOALS) && window.STARBIN_KUIS_SOALS.length > 0
      ? window.STARBIN_KUIS_SOALS.filter((s) => Array.isArray(s.options) && s.options.length > 0)
      : [];

  const quizData =
    dbQuizSoals.length > 0
      ? dbQuizSoals.map((s) => ({
          question: s.pertanyaan,
          options: s.options.map((o) => ({
            text: o.text,
            score: String(o.jurusan_id),
            weight: Number(o.bobot) || 1
          }))
        }))
      : [
          {
            question: "Bidang aktivitas apa yang paling membuatmu bersemangat?",
            options: jurusanSource.slice(0, 4).map((j) => ({
              text: `Mempelajari dan mempraktikkan keahlian di bidang ${j.nama}.`,
              score: String(j.id),
              weight: 1
            }))
          },
          {
            question: "Lingkungan belajar atau kerja seperti apa yang paling kamu sukai?",
            options: jurusanSource.slice(0, 4).map((j) => ({
              text: `Berkarya dan berkarier sebagai spesialis di jalur ${j.kode || j.nama}.`,
              score: String(j.id),
              weight: 1
            }))
          }
        ];

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
      currentQuizIndex = 0;
      quizScores = {};
      if (quizProgressFill) quizProgressFill.style.width = "0%";
      quizStartView.classList.remove("active");
      quizResultView.classList.remove("active");
      quizQuestionView.classList.add("active");
      showQuizQuestion();
    });
  }

  function showQuizQuestion() {
    if (!quizData.length) return;
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
      btn.addEventListener("click", () => handleQuizAnswer(opt.score, opt.weight || 1));
      quizOptionsContainer.appendChild(btn);
    });
  }

  function handleQuizAnswer(scoreKey, weight = 1) {
    quizScores[scoreKey] = (quizScores[scoreKey] || 0) + weight;
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

    let highestScore = -1;
    let recommendedJurusan = defaultJurusanKey;

    for (const key in quizScores) {
      if (quizScores[key] > highestScore && targetJurusan[key]) {
        highestScore = quizScores[key];
        recommendedJurusan = key;
      }
    }

    const result = targetJurusan[recommendedJurusan] || targetJurusan[defaultJurusanKey];
    latestRecommendedTitle = result ? result.title : "Kompetensi Keahlian Pilihan";
    resultTitle.innerText = latestRecommendedTitle;
    resultDesc.innerText = result ? result.desc : "";
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