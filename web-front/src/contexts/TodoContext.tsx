/**
 * TodoContext
 *
 * @package contexts
 */

import { FC } from 'react';

type Props = {
  children: React.ReactNode;
};

/**
 * TodoProvider
 *
 * @package contexts
 */
export const TodoProvider: FC<Props> = ({ children }) => {
  // カスタムフックから状態とロジックを呼び出してコンテキストプロバイダーにあてがう
  const { originTodoList } = useTodo();
};
