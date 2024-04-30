import React, { useEffect, useState } from 'react';
import assets from '../../assets';
import VideoFrame from './VideoFrame';
import VideoActions from './VideoActions';
import AddComment from './AddComment';
import CommentsList from './CommentsList';
import EditComment from './EditComment';
import { useDispatch, useSelector } from 'react-redux';
import { getComments } from '../../../redux/video/videoSlice';
export default function VideoPlayer({ video }) {
    const {
        id,
        comments,
        user,
        video_id,
        created_at,
        like,
        dislike,
        likes_count,
        dislikes_count,
        title,
        updated_at,
        user_id,
        views,
    } = video || {};

    const dispatch = useDispatch();
    const editCommentFormStatus = useSelector(
        (state) => state.video.commentEditForm
    );

    useEffect(function () {
        dispatch(getComments({ comments }));
    }, []);

    return (
        <main
            className='w-full min-h-screen flex flex-col items-center justify-center mt-24 object-fit bg-cover'
            style={{
                backgroundImage: `url('${assets.images.bg.texture}')`,
            }}>
            <div className='container flex flex-col xl:flex-row gap-6 py-4'>
                <article className='w-full xl:w-65/100'>
                    <VideoFrame
                        id={id}
                        videoId={video_id}
                        title={title}
                        views={views}
                        createdAt={created_at}
                        userId={user_id}
                    />
                    <VideoActions
                        id={id}
                        user={user}
                        like={like}
                        dislike={dislike}
                        videoId={video_id}
                        likesCount={likes_count}
                        dislikesCount={dislikes_count}
                    />
                </article>

                {/* Comments Section*/}
                <article className='w-full xl:w-35/100'>
                    <div className='bg-[#DBF1F030] p-4 shadow-main'>
                        {editCommentFormStatus ? (
                            <EditComment />
                        ) : (
                            <AddComment videoId={id} />
                        )}

                        {/* Comments*/}
                        <CommentsList />
                    </div>
                </article>
            </div>
        </main>
    );
}
