function cuteAlert({type: e, title: t, message: r, buttonText: s = "OK", confirmText: a = "OK", cancelText: l = "Cancel", closeStyle: c}) {
    return new Promise(n => {
        let o = document.querySelector("body"),
            i = document.getElementsByTagName("script"),
            d = "";
        for (let u of i) {
            if (u.src && u.src.includes("cute-alert.js")) {
                d = u;
                break;
            }
        }
        let v = d ? d.src.substring(0, d.src.lastIndexOf("/")) : "";
        let m = "alert-close";
        if ("circle" === c) m = "alert-close-circle";

        let b = `<button class="alert-button ${e}-bg ${e}-btn">${s}</button>`;
        if ("question" === e) {
            b = `<div class="question-buttons">
                <button class="confirm-button ${e}-bg ${e}-btn">${a}</button>
                <button class="cancel-button error-bg error-btn">${l}</button>
            </div>`;
        }

        let imgTag = v ? `<img class="alert-img" src="${v}/img/${e}.svg" onerror="this.style.display='none'" />` : "";

        let g = `<div class="alert-wrapper">
            <div class="alert-frame">
                <div class="alert-header ${e}-bg">
                    <span class="${m}">X</span>
                    ${imgTag}
                </div>
                <div class="alert-body">
                    <span class="alert-title">${t}</span>
                    <span class="alert-message">${r}</span>
                    ${b}
                </div>
            </div>
        </div>`;

        o.insertAdjacentHTML("afterend", g);

        let y = document.querySelector(".alert-wrapper"),
            f = document.querySelector(".alert-frame"),
            p = document.querySelector(`.${m}`);

        if ("question" === e) {
            let q = document.querySelector(".confirm-button"),
                S = document.querySelector(".cancel-button");
            if (q) q.addEventListener("click", () => { y.remove(); n("confirm"); });
            if (S) S.addEventListener("click", () => { y.remove(); n(); });
        } else {
            let E = document.querySelector(".alert-button");
            if (E) E.addEventListener("click", () => { y.remove(); n(); });
        }

        if (p) p.addEventListener("click", () => { y.remove(); n(); });
        if (y) y.addEventListener("click", () => { y.remove(); n(); });
        if (f) f.addEventListener("click", event => { event.stopPropagation(); });
    });
}

function cuteToast({type: e, message: t, timer: r = 5000}) {
    return new Promise(s => {
        let existingContainer = document.querySelector(".toast-container");
        if (existingContainer) existingContainer.remove();

        let a = document.querySelector("body"),
            l = document.getElementsByTagName("script"),
            c = "";
        for (let n of l) {
            if (n.src && n.src.includes("cute-alert.js")) {
                c = n;
                break;
            }
        }
        let o = c ? c.src.substring(0, c.src.lastIndexOf("/")) : "";
        let imgTag = o ? `<img class="toast-img" src="${o}/img/${e}.svg" onerror="this.style.display='none'" />` : "";

        let i = `<div class="toast-container ${e}-bg">
            <div>
                <div class="toast-frame">
                    ${imgTag}
                    <span class="toast-message">${t}</span>
                    <div class="toast-close">X</div>
                </div>
                <div class="toast-timer ${e}-timer" style="animation: timer ${r}ms linear;"/>
            </div>
        </div>`;

        a.insertAdjacentHTML("afterend", i);

        let d = document.querySelector(".toast-container");
        let timeout = setTimeout(() => {
            if (d) d.remove();
            s();
        }, r);

        let u = document.querySelector(".toast-close");
        if (u) {
            u.addEventListener("click", () => {
                clearTimeout(timeout);
                if (d) d.remove();
                s();
            });
        }
    });
}
