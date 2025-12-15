/* ===============================
   NEPSUS QR CODE GENERATOR JS
   =============================== */

let nepsusQR = null;

function generateNepsusQR() {
    const input = document.getElementById('qr-input');
    const output = document.getElementById('qr-output');
    const downloadBtn = document.getElementById('download-btn');
    const clearBtn = document.getElementById('clear-btn');

    if (!input || !output) return;

    const text = input.value.trim();

    if (text === '') {
        output.innerHTML = '<p>Please enter text or URL.</p>';
        return;
    }

    // Reset
    output.innerHTML = '';
    downloadBtn.style.display = 'none';
    clearBtn.style.display = 'none';

    // Generate QR
    nepsusQR = new QRCode(output, {
        text: text,
        width: 220,
        height: 220
    });

    // Enable download after render
    setTimeout(() => {
        const canvas = output.querySelector('canvas');
        if (canvas) {
            const url = canvas.toDataURL('image/png');
            downloadBtn.href = url;
            downloadBtn.download = 'qr-code.png';
            downloadBtn.style.display = 'block';
            clearBtn.style.display = 'block';
        }
    }, 300);
}

function clearNepsusQR() {
    const input = document.getElementById('qr-input');
    const output = document.getElementById('qr-output');
    const downloadBtn = document.getElementById('download-btn');
    const clearBtn = document.getElementById('clear-btn');

    if (input) input.value = '';
    if (output) output.innerHTML = '';
    if (downloadBtn) downloadBtn.style.display = 'none';
    if (clearBtn) clearBtn.style.display = 'none';
}