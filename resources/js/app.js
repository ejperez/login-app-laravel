import { debounce } from "lodash";

const apiValidation = async (route, body) => {
    const token = document.getElementsByName("_token")[0];

    const response = await fetch(`/api/v1/${route}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token.value,
        },
        body: JSON.stringify(body),
    });

    if (!response.ok) {
        throw new Error("Network response was not ok");
    }

    const data = await response.json();

    return data;
};

const checkEmail = async (email) => {
    if (email.indexOf("@") === -1) {
        return false;
    }

    try {
        const data = apiValidation("check-email", { email: email });

        if (data.exists) {
            document.getElementById("email-error").textContent =
                "The email has already been taken.";
        } else {
            document.getElementById("email-error").textContent = "";
        }
    } catch (error) {
        document.getElementById(
            "email-error"
        ).textContent = `Error checking email: ${error}`;
        return false;
    }
};

const debouncedCheckEmail = debounce(checkEmail, 500);

const checkUserName = async (username) => {
    if (username.length < 3) {
        return false;
    }

    try {
        const data = await apiValidation("check-username", {
            username: username,
        });

        if (data.exists) {
            document.getElementById("name-error").textContent =
                "The username has already been taken.";
        } else {
            document.getElementById("name-error").textContent = "";
        }
    } catch (error) {
        document.getElementById(
            "name-error"
        ).textContent = `Error checking username: ${error}`;
        return false;
    }
};

const debouncedcheckUserName = debounce(checkUserName, 500);

window.addEventListener("DOMContentLoaded", () => {
    document
        .querySelector("form#registration-form input#name")
        ?.addEventListener("keyup", (e) => {
            debouncedcheckUserName(e.target.value);
        });

    document
        .querySelector("form#registration-form input#email")
        ?.addEventListener("keyup", (e) => {
            debouncedCheckEmail(e.target.value);
        });

    const successModal = document.querySelector("div#success-modal");

    if (successModal) {
        setTimeout(() => {
            window.location.href = successModal.dataset.redirectTo;
        }, 1000);
    }
});
