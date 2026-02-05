import React from "react";
import { ChevronLeft, ChevronRight } from "lucide-react";
import clsx from "clsx";

type PaginationProps = {
  currentPage: number;
  totalPages: number;
  onPageChange: (page: number) => void;
};

export const Pagination: React.FC<PaginationProps> = ({
  currentPage,
  totalPages,
  onPageChange,
}) => {
  const getPageNumbers = () => {
    const pages: (number | string)[] = [];
    const maxVisible = 7;

    if (totalPages <= maxVisible) {
      // Afficher toutes les pages si moins de 7
      for (let i = 1; i <= totalPages; i++) {
        pages.push(i);
      }
    } else {
      // Toujours afficher la première page
      pages.push(1);

      if (currentPage <= 3) {
        // Près du début : 1 2 3 4 ... N
        for (let i = 2; i <= 4; i++) {
          pages.push(i);
        }
        pages.push("...");
        pages.push(totalPages);
      } else if (currentPage >= totalPages - 2) {
        // Près de la fin : 1 ... N-3 N-2 N-1 N
        pages.push("...");
        for (let i = totalPages - 3; i <= totalPages; i++) {
          pages.push(i);
        }
      } else {
        // Au milieu : 1 ... X-1 X X+1 ... N
        pages.push("...");
        pages.push(currentPage - 1);
        pages.push(currentPage);
        pages.push(currentPage + 1);
        pages.push("...");
        pages.push(totalPages);
      }
    }

    return pages;
  };

  const handlePageChange = (page: number) => {
    if (page >= 1 && page <= totalPages && page !== currentPage) {
      onPageChange(page);
      // Scroll en haut de la liste
      window.scrollTo({ top: 0, behavior: "smooth" });
    }
  };

  if (totalPages <= 1) return null;

  const pageNumbers = getPageNumbers();

  return (
    <div className="flex items-center justify-center gap-2 py-8">
      {/* Flèche gauche */}
      <button
        onClick={() => handlePageChange(currentPage - 1)}
        disabled={currentPage === 1}
        className={clsx(
          "flex h-10 w-10 items-center justify-center rounded-lg border transition",
          currentPage === 1
            ? "cursor-not-allowed border-slate-200 bg-slate-50 text-slate-400"
            : "border-slate-300 bg-white text-slate-700 hover:border-junspro-400 hover:bg-junspro-50 hover:text-junspro-700"
        )}
        aria-label="Page précédente"
      >
        <ChevronLeft className="h-5 w-5" />
      </button>

      {/* Numéros de pages */}
      <div className="flex items-center gap-1">
        {pageNumbers.map((page, idx) => {
          if (page === "...") {
            return (
              <span key={`ellipsis-${idx}`} className="px-2 text-slate-500">
                ...
              </span>
            );
          }

          const pageNum = page as number;
          const isActive = pageNum === currentPage;

          return (
            <button
              key={pageNum}
              onClick={() => handlePageChange(pageNum)}
              className={clsx(
                "flex h-10 min-w-[40px] items-center justify-center rounded-lg px-3 text-sm font-medium transition",
                isActive
                  ? "bg-junspro-button text-white shadow-sm"
                  : "bg-white text-slate-700 hover:bg-slate-50 hover:text-junspro-700"
              )}
            >
              {pageNum}
            </button>
          );
        })}
      </div>

      {/* Flèche droite */}
      <button
        onClick={() => handlePageChange(currentPage + 1)}
        disabled={currentPage === totalPages}
        className={clsx(
          "flex h-10 w-10 items-center justify-center rounded-lg border transition",
          currentPage === totalPages
            ? "cursor-not-allowed border-slate-200 bg-slate-50 text-slate-400"
            : "border-slate-300 bg-white text-slate-700 hover:border-junspro-400 hover:bg-junspro-50 hover:text-junspro-700"
        )}
        aria-label="Page suivante"
      >
        <ChevronRight className="h-5 w-5" />
      </button>
    </div>
  );
};


