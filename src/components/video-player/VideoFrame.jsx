import moment from 'moment';
import React, { useState } from 'react';
import assets from '../../assets';
import CsrfToken from '../../../utils/CsrfToken';
import { useSelector } from 'react-redux';

export default function VideoFrame({
    id,
    videoId,
    createdAt,
    title,
    views,
    userId,
}) {
    const [newTitle, setNewTitle] = useState(title || '');
    const [editTitleForm, setEditTitleForm] = useState(false);
    const { isAuth, user: user } = useSelector((state) => state.auth) || {};

    async function editTitleHandler(e) {
        e.preventDefault();

        try {
            const url = window.route(`/user/video/update-video-title/${id}`);

            if (newTitle.length > 300) {
                return fireToast(
                    'Your title length is so much long which more then 300 character'
                );
            }

            const response = await fetch(url, {
                body: new FormData(e.target),
                method: 'POST',
            });

            const result = await response.json();

            if (result.status === 'success') {
                setEditTitleForm(false);
                return fireToast(result.message, 'success');
            }

            setNewTitle(title);
            setEditTitleForm(false);
            return fireToast('Something went wrong!');
        } catch (error) {
            fireToast(
                `There is an error occurred "${error?.message}". Please try again later!`
            );
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
        <div className='w-full'>
            <div className='w-full p-4 shadow-main bg-transparent'>
                <iframe
                    className='w-full min-h-72 sm:min-h-96 md:min-h-[60vh] rounded-xl border border-solid border-primary'
                    title='YouTube video player'
                    frameBorder='0'
                    src={`https://drive.google.com/file/d/${videoId}/preview`}
                    allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share'
                    allowFullScreen=''></iframe>
            </div>

            <div className='font-primary pt-4 flex gap-2'>
                <div className='w-full'>
                    <p className='text-sm font-bold text-secondary'>
                        <span className='tracking-wide'>{views}</span>
                        <span className='text-sm font-light text-slate-600 pl-1'>
                            views
                        </span>
                    </p>

                    {userId === user?.id && (
                        <>
                            {!editTitleForm ? (
                                <p className='break-words tracking-wide leading-6 pb-2 sm:pb-0 text-2xl md:text-3xl text-secondary'>
                                    {newTitle}
                                    <button
                                        className='bg-slate-100 p-2 ml-3 text-white fill-primary rounded-full border border-slate-400 duration-500 hover:bg-primary hover:shadow-secondary hover:fill-white'
                                        onClick={() => setEditTitleForm(true)}>
                                        {assets.svg.edit(16, 16)}
                                    </button>
                                </p>
                            ) : (
                                <form
                                    onSubmit={editTitleHandler}
                                    className='flex gap-3 py-4 items-center justify-center'>
                                    <CsrfToken />

                                    <textarea
                                        name='title'
                                        value={newTitle}
                                        onChange={(e) =>
                                            setNewTitle(e.target.value)
                                        }
                                        className='w-full border-1 border-primary border-solid outline-none shadow border rounded-md bg-slate-50 h-14 focus:border-2 break-words tracking-wide leading-6 px-4 py-2 text-2xl md:text-3xl text-secondary'></textarea>
                                    <button className='bg-primary !w-12 !h-12 text-white rounded-full border border-slate-400 duration-500 hover:bg-secondary hover:drop-shadow-secondary fill-white flex items-center justify-center'>
                                        {assets.svg.send(20, 17)}
                                    </button>
                                    <p
                                        className='bg-red-400 !w-12 !h-12 text-white rounded-full border border-slate-400 duration-500 hover:bg-red-600 hover:drop-shadow-secondary fill-white flex items-center justify-center cursor-pointer'
                                        onClick={() => setEditTitleForm(false)}>
                                        {assets.svg.xMark()}
                                    </p>
                                </form>
                            )}
                        </>
                    )}
                    <small className='text-md font-poppins text-slate-500 italic'>
                        {moment(createdAt).format('LLLL')}
                    </small>
                </div>
            </div>
        </div>
    );
}
