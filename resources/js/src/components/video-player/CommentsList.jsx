import React, { useEffect } from "react";
import Comment from "./Comment";
import { useSelector, useDispatch } from "react-redux";
import GridError from "../../utils/GridError";
import { fetchComments } from "../../redux/comment/commentSlice";
import { useParams } from "react-router-dom";
import BallTriangleLoader from "../../utils/BallTriangleLoader";
import Pagination from "../../utils/Pagination";
import CommentPagination from "./CommentPagination";

export default function CommentsList() {
    const dispatch = useDispatch();
    const { id } = useParams();

    useEffect(
        function () {
            dispatch(fetchComments(id));
        },
        [dispatch]
    );

    const { isLoading, isError, comments, error } = useSelector(
        (state) => state.comment
    );

    if (isLoading) return <BallTriangleLoader message={error} />;

    if (!isLoading && isError) return <GridError message={error} />;

    if (!isLoading && !isError && comments)
        return (
            <div
                className="mt-6 max-h-[calc(100vh_-_365px)] overflow-x-hidden pr-3"
                id="custom-scrollbar"
            >
                <CommentPagination
                    links={comments.links}
                    firstPageUrl={comments.first_page_url}
                    lastPageUrl={comments.last_page_url}
                />
                {Array.isArray(comments.data) ? (
                    comments.data.map((comment) => (
                        <Comment comment={comment} key={comment.id} />
                    ))
                ) : (
                    <GridError message={error} />
                )}
            </div>
        );
}
