import CopyrightAlert from "./CopyrightAlert";
import FooterContents from "./FooterContents";

export default function Footer() {
  return (
    <div className="w-full bg-primary-lite text-slate-700">
      <FooterContents />
      <CopyrightAlert />
    </div>
  );
}
