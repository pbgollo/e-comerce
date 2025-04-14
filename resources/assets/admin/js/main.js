function Main() {
    function init() {
        $(".js-open-collapse").on("click", menu_toggle);
        $(".mobile-menu").on("click", mobile_toggle);
        $(".mobile-close").on("click", mobile_toggle);
        $(".js-generate-text-icon").on("click", openAiForm);
        $(".js-translate-ai").on("click", translateAI);
        $(".js-translate-unique-ai").on("click", translateUniqueAI);
        $(".js-ai-close").on("click", closeAiForm);
        $(".js-translate-unique-ai").on("mouseover", showTranslateDescription);
        $(".js-generate-text-icon").on("mouseover", showPromptDescription)
        $(".js-translate-unique-ai").on("mouseout", hideTranslateDescription);
        $(".js-generate-text-icon").on("mouseout", hidePromptDescription)
    }

    function translateAI() {
        const currentForm = $(this).closest("form");
        const currentLang = currentForm
            .find(".js-lang-tab.active")
            .data("select-lang");

        $(".js-nav-ai-form-feedback").text("Traduzindo...");
        $(".js-nav-ai-form-feedback").addClass("show");

        const portugueseInputs = $("[name*='[pt]']")
            .filter('input[type="text"], textarea')
            .map(function () {
                return {
                    name: $(this).attr("name"),
                    value: $(this).val(),
                };
            })
            .get();

        $.ajax({
            url: "/gerenciador/chatgpt-service",
            method: "POST",
            data: {
                action: "getCurrentField",
                inputs: portugueseInputs,
                currentLang: currentLang,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                console.log("Resposta do servidor:", response);

                response.translatedInputs.forEach(function (translatedInput) {
                    const translatedName = translatedInput.name;
                    const translatedValue =
                        translatedInput.value.generated_text;

                    const inputToUpdate = $("[name='" + translatedName + "']");

                    if (inputToUpdate.length) {
                        if (
                            inputToUpdate.is("textarea") &&
                            CKEDITOR.instances[inputToUpdate.attr("id")]
                        ) {
                            CKEDITOR.instances[
                                inputToUpdate.attr("id")
                            ].setData(translatedValue);
                        } else {
                            inputToUpdate.val(translatedValue);
                        }
                    }
                });

                $(".js-nav-ai-form-feedback").text("Operação realizada com sucesso!");
                setTimeout(() => {
                    $(".js-nav-ai-form-feedback").removeClass("show");
                }, 3000);
            },
            error: function (xhr, status, error) {
                console.error("Erro na requisição:", error);
                $(".js-nav-ai-form-feedback").text("Erro na tradução.");
                setTimeout(() => {
                    $(".js-nav-ai-form-feedback").removeClass("show");
                }, 3000);
            },
        });
    }

    function translateUniqueAI() {
        const currentForm = $(this).closest("form");
        const currentLang = currentForm
            .find(".js-lang-tab.active")
            .data("select-lang");

        const inputName = $(this)
            .closest(".form-group-label")
            .siblings("input, textarea")
            .attr("name");

        const inputNamePt = inputName.replace(`[${currentLang}]`, "[pt]");

        const inputPt = currentForm
            .find(
                `input[name='${inputNamePt}'], textarea[name='${inputNamePt}']`
            )
            .val();

        const inputElement = $(this)
            .closest(".form-group-label")
            .siblings("input, textarea");

        $(".js-nav-ai-form-feedback").text("Traduzindo...");
        $(".js-nav-ai-form-feedback").addClass("show");

        $.ajax({
            url: "/gerenciador/chatgpt-unique-translate",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                prompt: inputPt,
                language: currentLang,
            },
            success: function (response) {
                const translatedContent = response.response.generated_text;

                if (
                    inputElement.is("textarea") &&
                    CKEDITOR.instances[inputElement.attr("id")]
                ) {
                    CKEDITOR.instances[inputElement.attr("id")].setData(
                        translatedContent
                    );
                } else {
                    inputElement.val(translatedContent);
                }

                $(".js-nav-ai-form-feedback").text("Operação realizada com sucesso!");
                setTimeout(() => {
                    $(".js-nav-ai-form-feedback").removeClass("show");
                }, 3000);
            },
            error: function (xhr, status, error) {
                console.error("Erro na requisição:", error);
                $(".js-nav-ai-form-feedback").text("Erro na tradução.");
                setTimeout(() => {
                    $(".js-nav-ai-form-feedback").removeClass("show");
                }, 3000);
            },
        });
    }

    function showTranslateDescription() {
        $(this).siblings(".js-translate-ai-description").text("Traduzir com IA")
        $(this).siblings(".js-translate-ai-description").addClass("active")
    }

    function showPromptDescription() {
        $(this).siblings(".js-translate-ai-description").text("Conteúdo com IA")
        $(this).siblings(".js-translate-ai-description").addClass("active")
    }

    function hideTranslateDescription() {
        $(this).siblings(".js-translate-ai-description").removeClass("active")
    }

    function hidePromptDescription() {
        $(this).siblings(".js-translate-ai-description").removeClass("active")
    }

    function menu_toggle() {
        $(this).parent().toggleClass("show");
    }

    function mobile_toggle() {
        $(".sidenav").toggleClass("active");
    }

    async function openAiForm() {
        const clickedIcon = $(this);
        const aiForm = $(".js-nav-ai-form");
        const aiPrompt = aiForm.find(".js-ai-prompt");
        const dataId = clickedIcon.attr("data-reference");
        const submitButton = aiForm.find("button[type='submit']");

        aiForm.attr("data-id", dataId).addClass("active");

        aiForm.off("submit").on("submit", async function (e) {
            e.preventDefault();

            const promptValue = aiPrompt.val();
            const targetElement = $(`[name="${dataId}"]`);

            submitButton.text("Enviando...").prop("disabled", true);

            try {
                const response = await sendAiRequest(promptValue);
                testInputTypeOnAiRequest(
                    response.response.generated_text,
                    targetElement
                );

                showTokensUsage(response.response.tokens_used);
            } catch (error) {
                console.error("Erro na requisição AJAX:", error);
            } finally {
                submitButton.text("Enviar").prop("disabled", false);
                closeAiForm();
            }
        });
    }

    function showTokensUsage(tokens) {
        // $(".js-nav-ai-form-feedback-text").text("Tokens utilizados: " + tokens);

        $(".js-nav-ai-form-feedback").addClass("show");
        setTimeout(() => {
            $(".js-nav-ai-form-feedback").removeClass("show");
        }, 5000);
    }

    function sendAiRequest(promptValue) {
        const cleanPromptValue = promptValue.replace(/\n/g, " ").trim();

        return new Promise((resolve, reject) => {
            $.ajax({
                url: "/gerenciador/chatgpt",
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: {
                    prompt: cleanPromptValue,
                },
                success: function (response) {
                    resolve(response);
                },
                error: function (xhr, status, error) {
                    reject(error);
                },
            });
        });
    }

    function testInputTypeOnAiRequest(promptValue, targetElement) {
        if (targetElement.is("input")) {
            targetElement.val(promptValue);
        } else if (targetElement.is("textarea")) {
            const formattedValue = promptValue.replace(/\n/g, "<br>");
            const ckeditorInstance =
                CKEDITOR.instances[targetElement.attr("id")];
            if (ckeditorInstance) {
                ckeditorInstance.setData(formattedValue);
            }
        }
    }

    function closeAiForm() {
        const aiForm = $(".js-nav-ai-form");
        const aiPrompt = $(".js-ai-prompt");

        aiForm.removeClass("active");

        setTimeout(() => aiPrompt.val(""), 1000);
    }

    return {
        init,
    };
}

$(function () {
    var main = new Main();
    main.init();
});
