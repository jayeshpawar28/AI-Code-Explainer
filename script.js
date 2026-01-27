let snippetCount = 0;

function explainCode() {
    const code = document.getElementById("code").value.trim();
    const btn = document.getElementById("explainBtn");
    const loader = document.getElementById("loader");
    const output = document.getElementById("output");
    // alert(code)
    if (!code) {
        alert("Please paste some code first.");
        return;
    }

    snippetCount++;
    const snippetId = snippetCount;

    // create preview (first 3 lines)
    const lines = code.split("\n");
    const preview = lines.slice(0, 3).join("\n") + (lines.length > 3 ? "\n..." : "");

    btn.disabled = true;
    btn.innerText = "Explaining...";
    loader.style.display = "block";

    fetch("explain.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ code })
    })
    .then(res => res.text())
    .then(data => {
    output.innerHTML = `
                <div class="card">
                    <div class="hint">
                        Snippet #${snippetId} 
                    </div>

                    <div class="code-preview" onclick="toggleCode(${snippetId})">
                        ${escapeHtml(preview)}
                    </div>

                    <pre class="full-code" id="code-${snippetId}">
        ${escapeHtml(code)}
                    </pre>

                    <div class="ai-output">
                        ${marked.parse(data)}
                    </div>
                </div>
            ` + output.innerHTML;
        })
    .catch(() => {
        alert("Error while explaining code");
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerText = "Explain Code";
        loader.style.display = "none";
    });
}

// toggle show/hide full code
function toggleCode(id) {
    const el = document.getElementById(`code-${id}`);
    el.style.display = el.style.display === "block" ? "none" : "block";
}

// prevent HTML breaking
function escapeHtml(text) {
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;");
}
