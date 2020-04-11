export default class ImagesHandler {
    constructor(quill, options = {}) {
        this.quill = quill
        this.options = options
        this.quill
            .getModule('toolbar')
            .addHandler('image', this.selectLocalImage.bind(this))
        this.quill.on('text-change', ( delta, oldContents, source ) => {
            const removeFromServer = this.options.removeFromServer || this.removeFromServer.bind(this)
            removeFromServer(delta, oldContents, source)
        })
    }

    selectLocalImage() {
		const input = document.createElement('input')
		input.setAttribute('type', 'file')
		input.setAttribute('accept', 'image/*')
		input.click()

		input.onchange = () => {
			const file = input.files[0]

			if (/^image\//.test(file.type)) {
				const checkBeforeSend =
					this.options.checkBeforeSend || this.checkBeforeSend.bind(this)
				checkBeforeSend(file, this.sendToServer.bind(this))
			} else {
                const typeMismatch = this.options.typeMismatch || this.typeMismatch.bind(this)
                typeMismatch()
            }
		};
	}

    typeMismatch(){
        console.warn('You could only upload images.')
    }

    checkBeforeSend(file, next) {
		next(file);
	}

    sendToServer(file) {
		if (this.options.customUploader) {
			this.options.customUploader(file, dataUrl => {
				this.insert(dataUrl);
			});
		} else {
            const url   = this.options.upload.url,
			callbackOK  = this.options.callbackOK || this.uploadImageCallbackOK.bind(this),
			callbackKOK = this.options.callbackKO || this.uploadImageCallbackKO.bind(this)

			if (url) {
                const init = {
                    method  : this.options.upload.method || 'POST',
                    name    : this.options.name || 'image',
                    headers : this.options.headers || {},
                    body    : {}
                }

				const fd = new FormData()
                fd.append(init.name, file)
				if (this.options.csrf) {
					fd.append(this.options.csrf.token, this.options.csrf.hash)
				}

                init.body = fd

                fetch(url, init)
                .then(response => {
                    return response.json()
                })
                .then(data => {
                    callbackOK(data[init.name], this.insert.bind(this));
                })

			} else {
				const reader = new FileReader();

				reader.onload = event => {
					callbackOK(event.target.result, this.insert.bind(this));
				};
				reader.readAsDataURL(file);
			}
		}
	}

    removeFromServer(delta, oldContents, source){
        if (source !== 'user') return

        let deleted = this.getImgsUrl(this.quill.getContents().diff(oldContents))[0]
        if (deleted) {
            let s1 = deleted.replace('/', '-')
            let s2 = s1.replace('/storage/', '')
            console.log(s2);
            const url   = this.options.delete.url+s2,

            init = {
                method  : this.options.delete.method || 'DELETE',
                name    : this.options.name || 'image',
                headers : this.options.headers || {},
            }

            fetch(url, init)
            .then(response => {
                return response.json()
            })
            .then(data => {
                console.log(data);
                //callbackOK(data[init.name], this.insert.bind(this));
            })
        }

    }

    insert(dataUrl) {
        console.log(dataUrl);
        const index =
			(this.quill.getSelection() || {}).index || this.quill.getLength();
        this.quill.insertEmbed(index, 'image', dataUrl, 'user');
	}

    uploadImageCallbackOK(response, next) {
		next(response);
	}

	/**
	 * callback on image upload failed
	 * @param {Any} error http error
	 */
	uploadImageCallbackKO(error) {
        console.error(error);
	}

    getImgsUrl(delta) {
        return delta.ops.filter(i => i.insert && i.insert.image).map(i => i.insert.image)
    }
}
