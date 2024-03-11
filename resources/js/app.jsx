// import "./bootstrap";

// import React, { useState } from "react";
// import { createRoot } from "react-dom/client";
// import "react-draft-wysiwyg/dist/react-draft-wysiwyg.css";
// import { Editor } from "react-draft-wysiwyg";
// import { EditorState, convertToRaw } from "draft-js";
// import draftToHtml from "draftjs-to-html";

// createRoot(document.getElementById("react-textarea-render")).render(
//     <DraftTextEditor />
// );

// function DraftTextEditor() {
//     const [editorState, setEditorState] = useState(EditorState.createEmpty());
//     const [texts, setTexts] = useState("");

//     return (
//         <div className="w-full">
//             <i className="hidden bg-transparent border-t border-primary border-solid !pb-2"></i>
//             <i className="hidden min-h-40 -mt-2 border border-primary border-solid relative shadow-md py-0 px-4 text-xl font-poppins font-normal text-slate-900 max-h-full !h-auto"></i>
//             <Editor
//                 placeholder="Write here something..."
//                 editorState={editorState}
//                 toolbarClassName="bg-white !pb-2"
//                 wrapperClassName="shadow-md bg-transparent border-solid border border-primary"
//                 editorClassName="bg-white border-t border-primary border-solid min-h-40 -mt-2 relative py-0 px-4 text-xl font-poppins font-normal text-slate-900 max-h-full !h-auto"
//                 onEditorStateChange={function (text) {
//                     setEditorState(text);
//                     setTexts(
//                         draftToHtml(
//                             convertToRaw(editorState.getCurrentContent())
//                         )
//                     );
//                 }}
//             />

//             <textarea
//                 name="wysiwyg-draft-editor"
//                 hidden
//                 disabled
//                 className="!hidden wysiwyg-draft-editor"
//                 value={texts}
//             ></textarea>
//         </div>
//     );
// }

/* createRoot(document.getElementById("react")).render(<App />);

function App() {
    return (
        <div>
             
        </div>
    );
} */
