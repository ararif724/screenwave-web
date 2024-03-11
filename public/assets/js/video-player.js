const loginBubble = document.querySelector("[login-bubble]");
const likeBtn = document.querySelector("[like-button]");
const dislikeBtn = document.querySelector("[dislike-button]");
const commentBox = document.querySelector("[comment-box]");
const videoCommentsContainer = document.querySelector("[video-comments]");
const editVideoTitle = document.querySelector("[video-title]");
const editComments = document.querySelectorAll("[edit-comment]");

loginBubble.onclick = () => loginBubble.classList.toggle("active");

likeBtn.onclick = async function () {
    const url = likeBtn.getAttribute("like-button");

    authCheck(async function () {
        if (url !== "#") {
            try {
                const response = await fetch(url);
                const data = await response.json();
                const likeContent = document.getElementById("like-content");
                const dislikeContent =
                    document.getElementById("dislike-content");

                if (data.status === 200) {
                    likeContent.querySelector("p").innerHTML = data.likes_count;
                    dislikeContent.querySelector("p").innerHTML =
                        data.dislikes_count;

                    if (data.like) {
                        likeContent.classList.add("active");
                        dislikeContent.classList.remove("active");
                    } else {
                        likeContent.classList.remove("active");
                        dislikeContent.classList.remove("active");
                    }
                }

                Toast.fire({ icon: data.type, text: data.message });
                return;
            } catch (error) {
                Toast.fire({
                    icon: "error",
                    text: "There is an serious error occurred!",
                });
                return;
            }
        }
    });
};

dislikeBtn.onclick = async function () {
    const url = dislikeBtn.getAttribute("dislike-button");

    authCheck(async function () {
        if (url !== "#") {
            try {
                const response = await fetch(url);
                const data = await response.json();
                const likeContent = document.getElementById("like-content");
                const dislikeContent =
                    document.getElementById("dislike-content");

                if (data.status === 200) {
                    likeContent.querySelector("p").innerHTML = data.likes_count;
                    dislikeContent.querySelector("p").innerHTML =
                        data.dislikes_count;

                    if (data.dislike) {
                        likeContent.classList.remove("active");
                        dislikeContent.classList.add("active");
                    } else {
                        likeContent.classList.remove("active");
                        dislikeContent.classList.remove("active");
                    }

                    Toast.fire({ icon: data.type, text: data.message });
                    return;
                }
            } catch (error) {
                Toast.fire({
                    icon: "error",
                    text: "There is an serious error occurred!",
                });
                return;
            }
        }
    });
};

commentBox.querySelector("#comment-submit-btn").onclick = function () {
    const url = commentBox.getAttribute("comment-box");

    authCheck(async function () {
        const texts = document.querySelector("#comment-textarea");

        try {
            const response = await fetch(url, {
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken(),
                },
                method: "POST",
                body: JSON.stringify({ description: texts.value }),
            });

            const data = await response.json();

            if (data.status === 200) {
                texts.value = "";

                videoCommentsContainer.insertAdjacentHTML(
                    "beforebegin",
                    commentComponent(data.comment)
                );
                Toast.fire({ icon: data.type, text: data.message });
            }

            // console.log(data);
            return;
        } catch (error) {
            Toast.fire({
                icon: "error",
                text: "There is an serious error occurred!",
            });
            return;
        }
    });
};

async function authCheck(callback) {
    if (isAuth) {
        await callback();
        return;
    }

    Toast.fire({
        icon: "error",
        text: "Please login first to like, dislike & comment a video.",
    });

    return;
}

function commentComponent(comment) {
    const { id, created_at, updated_at, description } = comment || {};

    return `
        <div class="p-2 bg-white rounded-md border border-solid border-slate-300 mt-3">
            <div class="flex gap-4">
                <figure>
                    <img
                        src="${userPicture}"
                        class="!w-10 !h-10 !min-w-10 rounded-full border border-primary shadow-main"
                        alt="${userName}"
                    />
                </figure>
                <div class="my-auto w-full">
                    <div class="w-full flex items-center justify-between">
                        <div class="my-auto">
                            <h1 class="leading-3">
                                <span class="text-2xl font-medium font-primary capitalize text-primary tracking-wide">
                                ${userName}
                                </span>
                                <br class="block sm:hidden" />
                                <span class="text-secondary text-sm italic font-light font-poppins sm:ml-3 my-auto leading-[0.1] sm:leading-4">
                                    Just Now
                                </span>
                            </h1>
                            <p class="font-light font-poppins text-sm sm:leading-[.3] text-slate-500">
                                @screen-wave
                            </p>
                        </div>

                        <div class="text-end">
                            <button class="bg-primary p-2 text-white fill-white rounded-full shadow-main duration-500 hover:bg-secondary hover:shadow-secondary">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 192 512"
                                    width="26"
                                    height="26"
                                >
                                    <path d="M96 184c39.8 0 72 32.2 72 72s-32.2 72-72 72-72-32.2-72-72 32.2-72 72-72zM24 80c0 39.8 32.2 72 72 72s72-32.2 72-72S135.8 8 96 8 24 40.2 24 80zm0 352c0 39.8 32.2 72 72 72s72-32.2 72-72-32.2-72-72-72-72 32.2-72 72z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="font-normal font-poppins text-md leading-6 text-slate-700 pt-2 px-2 relative -ml-14">
                        <p class="leading-6 w-full text-start">${description}</p>
                    </div>
                </div>
            </div>
        </div>
    `;
}

editVideoTitle.onclick = async function () {
    // const previousTitle = "";
    const data = JSON.parse(editVideoTitle.getAttribute("video-title"));

    await authCheck(async function () {
        try {
            document.body.insertAdjacentHTML(
                "beforebegin",
                await editForm(
                    {
                        inputFields: [
                            {
                                text: data.title,
                                name: "title",
                                label: data.label,
                                type: "textarea",
                                options: "(max 254 letters)",
                            },
                        ],
                        url: data.url,
                    },
                    { isDelete: false, deleteUrl: "#" }
                )
            );
        } catch (error) {
            Toast.fire({
                icon: error,
                text: "There is an serious error occurred!",
            });
        }
    });

    formRemover();
    // console.log(data);
};

{
    /* <div class="fixed top-0 left-0 w-full bg-black/50 min-h-screen flex items-center justify-center z-20"> </div> */
}

async function editForm(
    { inputFields = [], url },
    { isDelete = false, deleteUrl = "" }
) {
    const bg = window.asset + "/assets/images/bg.jpg";

    return `
        <div class="fixed top-0 left-0 w-full bg-black/50 min-h-screen flex items-center justify-center z-20" id="edit-form">
            <form method="post" action="${url}" class="container xl:max-w-3xl w-full object-cover bg-cover h-full p-4 md:p-10 rounded-lg shadow-primary-deep relative" style="background-image: url(${bg})">
                <input type="hidden" name="_token" value="${csrfToken()}" autocomplete="off">

                <div class="absolute top-2 right-2 cursor-pointer" id="remove-edit-form">
                    <p class="text-lg font-bold bg-primary duration-500 text-slate-100 hover:bg-red-500 py-1 px-3 rounded-full hover:rotate-90">
                        X
                    </p>
                </div>

                ${inputFields
                    .map(
                        (input) =>
                            `<div>
                                <label
                                    for="${input.name}"
                                    class="text-md font-light text-slate-600 capitalize mb-1 font-jockey"
                                >
                                    ${input.label}
                                    ${
                                        input?.options
                                            ? `<span class="text-sm pl-1 text-red-400 font-light font-poppins">${input.options}</span>`
                                            : ""
                                    }
                                    
                                </label>

                                ${inputField(input)}
                            </div>`
                    )
                    .join("")}

                <div class="mt-4 w-full flex gap-4 items-center justify-end">
                    <button class="text-lg font-semibold tracking-wide rounded-md hover:tracking-wider hover:bg-primary hover:drop-shadow-primary duration-500 uppercase bg-secondary text-slate-100 py-1 px-3">update</button>
                    ${
                        isDelete
                            ? `<a href="${deleteUrl}" class="text-lg font-semibold tracking-wide rounded-md hover:tracking-wider hover:bg-red-500 hover:drop-shadow-primary duration-500 uppercase bg-red-400 text-slate-100 py-1 px-3">delete</a>`
                            : ""
                    }
                </div>
            </form>
        </div>
    `;
}

function formRemover() {
    document.getElementById("remove-edit-form").onclick = function () {
        document.getElementById("edit-form").remove();

        // console.log("Clicked");
    };
}

function inputField(input) {
    const { type, name, text, label } = input || {};

    switch (type) {
        case "textarea":
            return `
                <textarea
                    name="${name}"
                    type="text"
                    class="w-full text-lg font-mono text-secondary font-semibold focus:border-4 focus:border-primary px-4 py-1.5 bg-slate-200 rounded outline-none border-solid border border-slate-600"
                    cols="30" rows="4"
                    placeholder="${label}"
                >${text}</textarea>
            `;
        default:
            return `
                <input
                    name="${name}"
                    type="${type}"
                    placeholder="${label}"
                    class="w-full text-lg font-mono text-secondary font-semibold focus:border-4 focus:border-primary px-4 py-1.5 bg-slate-200 rounded outline-none border-solid border border-slate-600"
                    value="${text}"
                />
            `;
    }
}

editComments.forEach(function (editComment) {
    editComment.onclick = async function (event) {
        const data = JSON.parse(editComment.getAttribute("edit-comment"));

        // console.log(data);
        await authCheck(async function () {
            try {
                document.body.insertAdjacentHTML(
                    "beforebegin",
                    await editForm(
                        {
                            inputFields: [
                                {
                                    text: data.description,
                                    name: "description",
                                    label: data.label,
                                    type: "textarea",
                                },
                            ],
                            url: data.editUrl,
                        },
                        { isDelete: true, deleteUrl: data.deleteUrl }
                    )
                );
            } catch (error) {
                Toast.fire({
                    icon: error,
                    text: "There is an serious error occurred!",
                });
            }
        });

        formRemover();
        // console.log(data);
    };
});

document.getElementById("share-icon").onclick = function () {
    const url = window.location.href;
    navigator.clipboard.writeText(url);

    Toast.fire({
        icon: "success",
        text: "Shared Link Copied In Your Clipboard!",
    });
};
