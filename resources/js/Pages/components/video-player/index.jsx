import React from "react";
import assets from "../../assets";
import VideoFrame from "./VideoFrame";
import VideoActions from "./VideoActions";
import AddComment from "./AddComment";
import CommentsList from "./CommentsList";
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

    console.log(video);

    return (
        <main
            className="w-full min-h-screen flex flex-col items-center justify-center mt-24 object-fit bg-cover"
            style={{
                backgroundImage: `url('${assets.images.bg.texture}')`,
            }}
        >
            <div className="container flex flex-col xl:flex-row gap-6 py-4">
                <article className="w-full xl:w-65/100">
                    <VideoFrame
                        id={id}
                        videoId={video_id}
                        title={title}
                        views={views}
                        createdAt={created_at}
                    />
                    <VideoActions
                        user={user}
                        like={like}
                        dislike={dislike}
                        videoId={video_id}
                        likesCount={likes_count}
                        dislikesCount={dislikes_count}
                    />
                </article>

                {/* Comments Section*/}
                <article className="w-full xl:w-35/100">
                    <div
                        className="bg-[#DBF1F030] p-4 shadow-main"
                        comment-box="http://localhost/screenwave-web/public/user/video/store-comment/1/3"
                    >
                        <AddComment />

                        {/* Comments*/}
                        <CommentsList comments={comments} />
                    </div>
                </article>
            </div>
        </main>
    );
}
