import assets from "../../assets";

export default function FeaturesListItem({ title, isNew = false }) {
  return (
    <p className="flex gap-2 items-center justify-center p-1">
      <span className="shadow-xl pr-2 drop-shadow-xl">
        {assets.svg.checkMark(22, 22, "rgb(86 90 221)")}
      </span>
      <span className="text-slate-200 capitalize font-light">{title}</span>
      {isNew && (
        <span className="text-xs font-semibold uppercase text-rose-500 drop-shadow-xl">
          NEW
        </span>
      )}
    </p>
  );
}
