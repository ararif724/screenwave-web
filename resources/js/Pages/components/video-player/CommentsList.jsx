import React from "react";
import Comment from "./Comment";

export default function CommentsList({ comments }) {
    return (
        <div
            className="mt-6 max-h-[calc(100vh_-_365px)] overflow-x-hidden pr-3"
            id="custom-scrollbar"
        >
            {comments?.map((comment) => (
                <Comment comment={comment} key={comment.id} />
            ))}
        </div>
    );
}
