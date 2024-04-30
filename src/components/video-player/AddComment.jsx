import React, { useState } from 'react';
import assets from '../../assets';
import CsrfToken from '../../../utils/CsrfToken';
import { useSelector } from 'react-redux';

export default function AddComment({ videoId }) {
    const [btnStatus, setBtnStatus] = useState(false);
    const { isAuth } = useSelector((state) => state.auth);

    async function addCommentHandler(e) {
        e.preventDefault();
        setBtnStatus(true);

        if (!isAuth) {
            return fireToast('Please Login first to comment here.');
        }

        try {
            const url = window.route(`/user/video/comment/store`);

            const formData = new FormData(e.target);
            formData.append('videoId', videoId);

            const response = await fetch(url, {
                body: formData,
                method: 'POST',
                headers: { method: 'POST' },
            });

            const result = await response.json();
            if (result.status === 'success') {
                // addNewComment(result.data);
                e.target.reset();
                return fireToast(result.message, 'success');
            }

            return fireToast('Something went wrong!');
        } catch (error) {
            fireToast(
                `There is an error occurred "${error?.message}". Please try again later!`
            );
        } finally {
            setBtnStatus(false);
        }

        return fireToast('Something went wrong!');
    }

    function fireToast(text, icon = 'error') {
        Toast.fire({
            icon,
            text,
        });
    }

    return (
        <form className='w-full' onSubmit={addCommentHandler} method='POST'>
            <CsrfToken />
            {/* Render the Main Comment Text Area*/}
            <textarea
                name='description'
                cols='30'
                rows='6'
                className='w-full resize-none outline-none border border-solid border-green-500 p-3 text-lg font-mono focus:border-2 text-slate-800 rounded-md'
                placeholder="Write here what's on your mind..."
                id='comment-textarea'></textarea>

            <div className='relative'>
                <div className='absolute z-10 p-2 bg-white bottom-3 right-1.5'>
                    <button
                        className='bg-primary text-white font-white flex gap-1 rounded-lg shadow-main'
                        disabled={btnStatus}>
                        <i
                            className='block py-2 px-3 bg-primary rounded-lg duration-500 hover:bg-secondary hover:drop-shadow-secondary cursor-pointer'
                            id='comment-submit-btn'>
                            {assets.svg.send()}
                        </i>
                    </button>
                </div>
            </div>
        </form>
    );
}
