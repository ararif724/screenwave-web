import React, { useEffect, useState } from "react";
import assets from "../../assets";
import VideoFrame from "./VideoFrame";
import VideoActions from "./VideoActions";
import AddComment from "./AddComment";
import CommentsList from "./CommentsList";
import EditComment from "./EditComment";
import { useDispatch, useSelector } from "react-redux";

export default function VideoPlayer({ video }) {
    const {
        id,
        user_id,
        title,
        google_drive_video_id,
        views,
        processing_competed,
        created_at,
        updated_at,
        likes_count,
        dislikes_count,
        video_url,
        download_url,
    } = video || {};

    const dispatch = useDispatch();

    const { user } = useSelector((state) => state.auth);
    const editCommentFormStatus = useSelector(
        (state) => state.comment?.commentEditForm
    );

    return (
        <main
            className="w-full min-h-screen flex flex-col items-center justify-center mt-24 object-fit bg-cover bg-white"
            // style={{
            //     backgroundImage: `url('${assets.images.bg.texture}')`,
            // }}
        >
            <div className="container flex flex-col xl:flex-row gap-6 py-4">
                <article className="w-full xl:w-65/100">
                    <VideoFrame
                        id={id}
                        videoId={google_drive_video_id}
                        title={title}
                        views={views}
                        createdAt={created_at}
                        userId={user_id}
                        videoUrl={video_url}
                    />
                    <VideoActions
                        id={id}
                        user={user}
                        like={0}
                        dislike={0}
                        videoId={google_drive_video_id}
                        likesCount={likes_count}
                        dislikesCount={dislikes_count}
                    />
                </article>

                {/* Comments Section*/}
                <article className="w-full xl:w-35/100">
                    <div className="bg-[#DBF1F030] p-4 shadow-main">
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
