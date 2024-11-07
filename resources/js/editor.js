import { Editor } from "@tiptap/core";
import StarterKit from "@tiptap/starter-kit";
import TextAlign from "@tiptap/extension-text-align";
import Image from "@tiptap/extension-image";
import YouTube from "@tiptap/extension-youtube";


window.addEventListener("load", function () {
    if (document.getElementById("wysiwyg-alignment-example")) {
        // tip tap editor setup
        const editor = new Editor({
            element: document.querySelector("#wysiwyg-alignment-example"),
            extensions: [StarterKit,Image, YouTube,TextAlign.configure({ types: ['heading', 'paragraph'],})],  // Bullet list support, BulletList, Image],
            content:'<p>type here...</p>',
            editorProps: {
                attributes: {
                    class: "format lg:format-lg dark:format-invert focus:outline-none format-blue",
                },
            },
        });

        
            // Button interactions for alignment and list
    document.getElementById('toggleLeftAlignButton').addEventListener('click', () => editor.chain().focus().setTextAlign('left').run())
    document.getElementById('toggleCenterAlignButton').addEventListener('click', () => editor.chain().focus().setTextAlign('center').run())
    document.getElementById('toggleRightAlignButton').addEventListener('click', () => editor.chain().focus().setTextAlign('right').run())
    document.getElementById('toggleJustifyButton').addEventListener('click', () => editor.chain().focus().setTextAlign('justify').run())


    document.getElementById('toggleLeftAlignButton').addEventListener('click', () => {
        editor.chain().focus().setTextAlign('left').run();
    });
    document.getElementById('toggleCenterAlignButton').addEventListener('click', () => {
        editor.chain().focus().setTextAlign('center').run();
    });
    document.getElementById('toggleRightAlignButton').addEventListener('click', () => {
        editor.chain().focus().setTextAlign('right').run();
    });
    // document.getElementById('toggleListButton').addEventListener('click', () => {
    //    editor.chain().focus().toggleBulletList().run();
    // });



            // Image Insertion Button
   // set up custom event listeners for the buttons
    document.getElementById('addImageButton').addEventListener('click', () => {
        const url = window.prompt('Enter image URL:', 'https://placehold.co/600x400');
        if (url) {
            editor.chain().focus().setImage({ src: url }).run();
        }
    });
        // set up custom event listeners for the buttons
        document
            .getElementById("addVideoButton")
            .addEventListener("click", () => {
                const url = window.prompt(
                    "Enter YouTube URL:",
                    "https://www.youtube.com/watch?v=KaLxCiilHns"
                );
                if (url) {
                    editor.commands.setYoutubeVideo({
                        src: url,
                        width: 440,
                        height: 480,
                    });
                }
            });


    }
});
