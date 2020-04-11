import Quill from 'quill'
import ImagesHandler from './quill-images-handler'

Quill.register('modules/imagesHandler', ImagesHandler)

/*
 * Editor posts
 */
let editor = document.getElementById('editor-container')
if (editor) {
    let quill = new Quill(editor, {
        modules: {
            imagesHandler:{
                upload: {
                    url: '/dashboard/users/images'
                },
                delete: {
                    url: '/dashboard/users/images/'
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            toolbar: [
                [{
                    header: [1, 2, false]
                }],
                ['bold', 'italic', 'underline'],
                [{
                        'color': ["#000000", "#e60000", "#ff9900", "#ffff00", "#008a00", "#0066cc", "#9933ff", "#ffffff", "#facccc", "#ffebcc", "#ffffcc", "#cce8cc", "#cce0f5", "#ebd6ff", "#bbbbbb", "#f06666", "#ffc266", "#ffff66", "#66b966", "#66a3e0", "#c285ff", "#888888", "#a10000", "#b26b00", "#b2b200", "#006100", "#0047b2", "#6b24b2", "#444444", "#5c0000", "#663d00", "#666600", "#003700", "#002966", "#3d1466", 'custom-color']
                    },
                    {
                        'align': [false, 'center', 'right', 'justify']
                    },
                ],
                ['image', 'code-block']
            ],
        },
        placeholder: 'Escribe algo asombroso',
        theme: 'snow'
    });

    let content = document.getElementById('content')
    quill.root.innerHTML = content.value

    let form = document.getElementById('post-form')
    form.onsubmit = () => {
        content.value = quill.root.innerHTML
    }
}
